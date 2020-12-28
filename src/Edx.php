<?php

namespace lesha724\DistanceLearning;

use lesha724\DistanceLearning\interfaces\ICourse;
use lesha724\DistanceLearning\interfaces\IUser;
use lesha724\DistanceLearning\models\BaseConnector;
use lesha724\DistanceLearning\throws\NotImplementedException;

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
}