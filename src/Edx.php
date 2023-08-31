<?php

namespace mazhurnyy\DistanceLearning;

use mazhurnyy\DistanceLearning\interfaces\ICourse;
use mazhurnyy\DistanceLearning\interfaces\IUser;
use mazhurnyy\DistanceLearning\models\BaseConnector;
use mazhurnyy\DistanceLearning\throws\NotImplementedException;

/**
 * Class Edx
 * @package mazhurnyy\DistanceLearning
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

    #region Courses
    /**
     * @return ICourse[]
     * @throws NotImplementedException
     */
    public function getCoursesList(): array
    {
        throw new NotImplementedException();
    }
    /**
     * @param int $courseId
     * @param array $membersId
     * @return bool
     * @throws NotImplementedException
     */
    public function subscribeToCourse(int $courseId, array $membersId): bool
    {
        throw new NotImplementedException();
    }

    /**
     * @param int $courseId
     * @param array $membersId
     * @return bool
     * @throws NotImplementedException
     */
    public function unsubscribeToCourse(int $courseId, array $membersId): bool
    {
        throw new NotImplementedException();
    }
    #endregion

    #region Users
    /**
     * Поиск пользователей
     * @param array $params
     * @return IUser[]
     * @throws NotImplementedException
     */
    public function getUsers(array $params): array
    {
        throw new NotImplementedException();
    }

    /**
     * Создание пользователя
     * @param array $params
     * @return IUser
     * @throws NotImplementedException
     */
    public function createUser(array $params): IUser
    {
        throw new NotImplementedException();
    }
    #endregion
    #endregion
}