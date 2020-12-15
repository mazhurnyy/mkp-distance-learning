<?php


namespace lesha724\DistanceLearning\models\edx;


use lesha724\DistanceLearning\interfaces\IUser;
use lesha724\DistanceLearning\models\BaseObject;

/**
 * Пользователь Edx
 * Class User
 * @package lesha724\DistanceLearning\models\edx
 */
class User extends BaseObject implements IUser
{

    public function getId(): int
    {
        return 0;
    }

    public function getEmail(): string
    {
        // TODO: Implement getEmail() method.
    }
}