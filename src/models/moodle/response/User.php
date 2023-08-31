<?php

namespace mazhurnyy\DistanceLearning\models\moodle\response;

use mazhurnyy\DistanceLearning\interfaces\IUser;
use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Пользователь moodle
 * Class User
 * @package mazhurnyy\DistanceLearning\models\moodle
 */
class User extends BaseObject implements IUser
{
    public $id;
    public $email;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}