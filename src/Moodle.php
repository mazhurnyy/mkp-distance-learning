<?php

namespace lesha724\DistanceLearning;

use lesha724\DistanceLearning\interfaces\IStudent;
use lesha724\DistanceLearning\models\BaseConnector;
use lesha724\DistanceLearning\models\Course;
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
     * @return Course[]|void
     */
    public function getCoursesList()
    {
        // TODO: Implement getCoursesList() method.
    }

    /**
     * @param int $courseId
     * @return Course
     *
     */
    public function getCourse(int $courseId): Course
    {
        // TODO: Implement getCourse() method.
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
}