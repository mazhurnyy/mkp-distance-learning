<?php

namespace lesha724\DistanceLearning;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use lesha724\DistanceLearning\interfaces\IUser;
use lesha724\DistanceLearning\models\BaseConnector;
use lesha724\DistanceLearning\models\moodle\request\Cohort as RequestCohort;
use lesha724\DistanceLearning\models\moodle\response\AddCohortMembers;
use lesha724\DistanceLearning\models\moodle\response\Cohort as ResponseCohort;
use lesha724\DistanceLearning\models\moodle\response\User;
use lesha724\DistanceLearning\models\moodle\response\Course;

/**
 * Class Moodle
 * @package lesha724\DistanceLearning
 */
class Moodle extends BaseConnector
{
    /**
     * код роли студента для записи на курсы
     * @var int
     *
     * @see subscribeToCourse
     * @see unsubscribeToCourse
     */
    public $studentRoleId = 5;

    /**
     * Moodle
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE_MOODLE;
    }

    #region Courses
    /**
     * Список курсов
     * @return Course[]|void
     * @throws throws\RequestException
     */
    public function getCoursesList()
    {
        $body = $this->_send('core_course_get_courses', 'GET');
        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка загрузки курсов moodle: Неверный формат ответа.');

        $result = [];
        foreach ($data as $course) {
            if(empty($course->visible))
                continue;
            $result[] = new Course([
                'id' => $course->id,
                'shortname' => $course->shortname,
                'displayname' => $course->displayname,
                'startdate' => $course->startdate,
                'enddate' => $course->enddate
            ]);
        }
        return $result;
    }
    #endregion

    /**
     * Отправка запроса по методу
     * @param string $method
     * @param string $type
     * @param array $params
     * @return string
     * @throws throws\RequestException
     */
    protected function _send(string $method, string $type = 'POST', array $params = []){
        $params['wstoken']=$this->getToken();
        $params['wsfunction']=$method;
        $params['moodlewsrestformat']='json';

        try {
            $response = $this->_sendQuery($this->getHost().'/webservice/rest/server.php', $type, $params);
            if($response->getStatusCode() == 200)
                return $response->getBody()->getContents();

            if($response->getStatusCode() == 204)
                return null;

            return null;

        } catch (RequestException $e) {
            if ($e->hasResponse())
                throw new throws\RequestException(Message::toString($e->getResponse()));

            throw new throws\RequestException(Message::toString($e->getRequest()));
        } catch (\Exception $e) {
            throw new throws\RequestException($e->getMessage());
        }
    }

    #region Users
    /**
     * Получить пользователя по параметрам
     * @param array $params
     * @return User[]
     * @throws throws\RequestException
     */
    public function getUsers(array $params): array
    {
        if(empty($params))
            throw new throws\RequestException('Не заданы параметры для поиска пользователя');

        $criteria = [];
        foreach ($params as $key => $value)
            $criteria[] = [
                'key'=>$key,
                'value'=>$value
            ];

        $body = $this->_send('core_user_get_users','GET',['criteria'=>$criteria]);
        $data = json_decode($body);
        $this->_processError($data);

        if(!isset($data->users))
            throw new throws\RequestException('Ошибка загрузки курсов moodle: Неверный формат ответа 2.');

        $users = [];
        foreach ($data->users as $user){
            $users[] = new User([
                'id' => $user->id,
                'email' => $user->email
            ]);
        }
        return $users;
    }

    /**
     * Создание пользователя
     * @param array $params
     * @return IUser
     * @throws throws\RequestException
     */
    public function createUser(array $params) : IUser {
        $body = $this->_send('core_user_create_users','GET',['users'=>[$params]]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка создания пользователя в moodle: Неверный формат ответа 1.');

        if(count($data) > 1)
            throw new throws\RequestException('Ошибка создания пользователя в moodle: Неверный формат ответа 2.');

        return new User([
            'id' => $data[0]->id,
            'email' => isset($params['email']) ? $params['email'] : ''
        ]);
    }
    #endregion

    #region Когорты
    /**
     * Создание когорты
     * @param RequestCohort $cohort
     * @return ResponseCohort[]
     * @throws throws\RequestException
     */
    public function createCohort(RequestCohort $cohort) : array {
        $body = $this->_send('core_cohort_create_cohorts','GET',['cohorts'=>[$cohort->getAttributes()]]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка создания когорт в moodle: Неверный формат ответа 1.');

        $result = [];
        foreach ($data as $item){
            $result[] = new ResponseCohort($item);
        }
        return $result;
    }

    /**
     * Добавить участников когорты
     * @param int $cohortId
     * @param int[]|string $membersId
     * @return AddCohortMembers
     * @throws throws\RequestException
     */
    public function addCohortMembers(int $cohortId, array $membersId) : AddCohortMembers
    {
        if(empty($cohortId) || empty($membersId))
            throw new throws\RequestException('Ошибка добавления участников когорт в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'cohorttype' => [
                    'type' => 'id',
                    'value' => $cohortId
                ],
                'usertype' => [
                    'type' => 'id',
                    'value' => $id
                ]
            ];
        }

        $body = $this->_send('core_cohort_add_cohort_members','GET',['members'=>[$params]]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка добавления участников когорт в moodle: Неверный формат ответа 1.');

        return new AddCohortMembers($data);
    }

    /**
     * Удалить участника из когорты
     * @param int $cohortId
     * @param int[] $membersId
     * @return bool
     * @throws throws\RequestException
     */
    public function deleteCohortMembers(int $cohortId, array $membersId) : bool {
        if(empty($cohortId) || empty($membersId))
            throw new throws\RequestException('Ошибка удаления участников когорт в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'cohortid' => $cohortId,
                'userid' => $id
            ];
        }
        $body = $this->_send('core_cohort_delete_cohort_members','GET',['members'=>$params]);
        if(empty($body))
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }
    #endregion

    /**
     * Анализ ошибки от мудла
     * @param $data object|array
     * @throws throws\RequestException
     */
    private function _processError($data)
    {
        if(isset($data->errorcode))
            throw new throws\RequestException('Ошибка moodle: '.$data->message);
    }
}