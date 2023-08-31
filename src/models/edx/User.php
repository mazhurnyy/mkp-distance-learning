<?php

namespace mazhurnyy\DistanceLearning\models\edx;

use mazhurnyy\DistanceLearning\interfaces\IUser;
use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Пользователь Edx
 * Class User
 * @package mazhurnyy\DistanceLearning\models\edx
 */
class User extends BaseObject implements IUser
{

    public function getId(): int
    {
        return 0;
    }

    public function getEmail(): string
    {
        return '';
    }
}