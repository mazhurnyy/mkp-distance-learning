<?php

namespace lesha724\DistanceLearning\models\moodle\response;

use lesha724\DistanceLearning\interfaces\IUser;
use lesha724\DistanceLearning\models\BaseObject;
use lesha724\DistanceLearning\traits\ObjectTrait;

/**
 * Пользователь мудла
 * Class User
 * @package lesha724\DistanceLearning\models\moodle
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