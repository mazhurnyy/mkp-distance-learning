<?php


namespace lesha724\DistanceLearning;


use lesha724\DistanceLearning\interfaces\ICourse;
use lesha724\DistanceLearning\interfaces\IStudent;
use lesha724\DistanceLearning\models\BaseConnector;

/**
 * Class Edx
 * @package lesha724\DistanceLearning
 */
class Edx extends BaseConnector
{
    #region Methods
    /**
     * EDX
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE_EDX;
    }
    /**
     * @return ICourse[]|void
     */
    public function getCoursesList()
    {
        // TODO: Implement getCoursesList() method.
    }

    public function subscribeToCourse(IStudent $student, int $courseId): bool
    {
        // TODO: Implement subscribeToCourse() method.
    }

    public function unsubscribeToCourse(IStudent $student, int $courseId): bool
    {
        // TODO: Implement unsubscribeToCourse() method.
    }

    public function validateEmail(string $email): bool
    {
        // TODO: Implement validateEmail() method.
    }
    #endregion
}