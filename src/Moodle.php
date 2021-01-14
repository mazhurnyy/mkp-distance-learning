<?php

namespace lesha724\DistanceLearning;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use lesha724\DistanceLearning\interfaces\IUser;
use lesha724\DistanceLearning\models\BaseConnector;
use lesha724\DistanceLearning\models\moodle\request\Cohort as RequestCohort;
use lesha724\DistanceLearning\models\moodle\response\AddCohortMembers;
use lesha724\DistanceLearning\models\moodle\response\Cohort as ResponseCohort;
use lesha724\DistanceLearning\models\moodle\response\Group as ResponseGroup;
use lesha724\DistanceLearning\models\moodle\request\Group as RequestGroup;
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
     * @return Course[]
     * @throws throws\RequestException
     */
    public function getCoursesList(): array
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
            if(empty($course->id))
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

    /**
     * Запись на курс
     * @param int $courseId
     * @param array $membersId
     * @return bool
     * @throws throws\RequestException
     */
    public function subscribeToCourse(int $courseId, array $membersId): bool
    {
        if(empty($courseId) || empty($membersId))
            throw new throws\RequestException('Ошибка записи студентов на курс в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'roleid' => $this->studentRoleId,
                'courseid' => $courseId,
                'userid' => $id
            ];
        }
        $body = $this->_send('enrol_manual_enrol_users','POST',['enrolments'=>$params]);
        if(empty($body) || $body==='null')
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }

    /**
     * Выписка с курса
     * @param int $courseId
     * @param array $membersId
     * @return bool
     * @throws throws\RequestException
     */
    public function unsubscribeToCourse(int $courseId, array $membersId): bool
    {
        if(empty($courseId) || empty($membersId))
            throw new throws\RequestException('Ошибка выписки студентов с курса в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'roleid' => $this->studentRoleId,
                'courseid' => $courseId,
                'userid' => $id
            ];
        }
        $body = $this->_send('enrol_manual_unenrol_users','POST',['enrolments'=>$params]);
        if(empty($body) || $body==='null')
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }
    #endregion

    /**
     * Отправка запроса по методу
     * @param string $method
     * @param string $type
     * @param array $params
     * @return string| null
     * @throws throws\RequestException
     */
    protected function _send(string $method, string $type = 'POST', array $params = []): ?string
    {
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
        } catch (GuzzleException $e) {
            throw new throws\RequestException($e->getMessage());
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
        $body = $this->_send('core_user_create_users','POST',['users'=>[$params]]);

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
     * @return ResponseCohort
     * @throws throws\RequestException
     */
    public function createCohort(RequestCohort $cohort) : ResponseCohort {
        $body = $this->_send('core_cohort_create_cohorts','POST',['cohorts'=>[$cohort->getAttributes()]]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка создания когорт в moodle: Неверный формат ответа 1.');

        if(count($data) > 1)
            throw new throws\RequestException('Ошибка создания когорт в moodle: Неверный формат ответа 2.');

        return new ResponseCohort($data[0]);
    }

    /**
     * Добавить участников когорты
     * @param int $cohortId
     * @param int[] $membersId
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

        $body = $this->_send('core_cohort_add_cohort_members','POST',['members'=>$params]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!isset($data->warnings) && !isset($data['warnings']))
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
        $body = $this->_send('core_cohort_delete_cohort_members','POST',['members'=>$params]);
        if(empty($body) || $body==='null')
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }
    #endregion

    #region Группы
    /**
     * Создание группы
     * @param RequestGroup $group
     * @return ResponseGroup
     * @throws throws\RequestException
     */
    public function createGroup(RequestGroup $group) : ResponseGroup{
        $body = $this->_send('core_group_create_groups','POST',['groups'=>[$group->getAttributes()]]);

        $data = json_decode($body);
        $this->_processError($data);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка создания группы в moodle: Неверный формат ответа 1.');

        if(count($data) > 1)
            throw new throws\RequestException('Ошибка создания группы в moodle: Неверный формат ответа 2.');

        return new ResponseGroup($data[0]);
    }

    /**
     * Удаление группы
     * @param int[] $groupsId
     * @return bool
     * @throws throws\RequestException
     */
    public function deleteGroups(array $groupsId) : bool {
        if(empty($groupsId))
            return false;

        $body = $this->_send('core_group_delete_groups','POST',['groupids'=>[$groupsId]]);

        if(empty($body) || $body==='null')
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }

    /**
     * Добавить участников группы
     * @param int $groupId
     * @param int[] $membersId
     * @return bool
     * @throws throws\RequestException
     */
    public function addGroupMembers(int $groupId, array $membersId) : bool
    {
        if(empty($groupId) || empty($membersId))
            throw new throws\RequestException('Ошибка добавления участников группы в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'groupid' => $groupId,
                'userid' => $id
            ];
        }

        $body = $this->_send('core_group_add_group_members','POST',['members'=>$params]);
        if(empty($body) || $body==='null')
            return true;

        $data = json_decode($body);
        $this->_processError($data);
        return false;
    }

    /**
     * Удалить участника из группы
     * @param int $groupId
     * @param int[] $membersId
     * @return bool
     * @throws throws\RequestException
     */
    public function deleteGroupMembers(int $groupId, array $membersId) : bool {
        if(empty($groupId) || empty($membersId))
            throw new throws\RequestException('Ошибка удаления участников когорт в moodle: Не переданы необходимые параметры.');

        $params = [];
        foreach ($membersId as $id){
            $params[] = [
                'groupid' => $groupId,
                'userid' => $id
            ];
        }
        $body = $this->_send('core_group_delete_group_members','POST',['members'=>$params]);
        if(empty($body) || $body==='null')
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
    private function _processError($data) : void
    {
        if(isset($data->errorcode))
            throw new throws\RequestException('Ошибка moodle: '.$data->message);
    }
}