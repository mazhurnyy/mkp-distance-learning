<?php

namespace lesha724\DistanceLearning;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use lesha724\DistanceLearning\interfaces\IStudent;
use lesha724\DistanceLearning\models\BaseConnector;
use lesha724\DistanceLearning\throws\NotImplementedException;

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
     * Список курсов
     * @return models\moodle\Course[]|void
     * @throws throws\RequestException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getCoursesList()
    {
        $body = $this->_send('core_course_get_courses', 'GET');
        $data = json_decode($body);
        if(!is_array($data))
            throw new throws\RequestException('Ошибка загрузки курсов moodle: Неверный формат ответа.');

        $result = [];
        foreach ($data as $course) {
            $result[] = new models\moodle\Course($course);
        }
        return $result;
    }

    /**
     * @param IStudent $student
     * @param int $courseId
     * @return bool
     * @throws NotImplementedException
     *
     * @see $studentRoleId
     */
    public function subscribeToCourse(IStudent $student, int $courseId): bool
    {
        // TODO: Implement subscribeToCourse() method.
        throw new NotImplementedException();
    }

    /**
     * @param IStudent $student
     * @param int $courseId
     * @return bool
     * @throws NotImplementedException
     *
     * @see $studentRoleId
     */
    public function unsubscribeToCourse(IStudent $student, int $courseId): bool
    {
        // TODO: Implement unsubscribeToCourse() method.
        throw new NotImplementedException();
    }

    public function validateEmail(string $email): bool
    {
        // TODO: Implement validateEmail() method.
        throw new NotImplementedException();
    }

    /**
     * Отправка запроса по методу
     * @param string $method
     * @param string $type
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
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
}