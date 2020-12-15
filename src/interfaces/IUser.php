<?php


namespace lesha724\DistanceLearning\interfaces;

/**
 * Interface IUser
 * @package lesha724\DistanceLearning\interfaces
 */
interface IUser
{
    /**
     * код пользователя
     * @return int
     */
    public function getId() : int;

    /**
     * email пользователя
     * @return string
     */
    public function getEmail() : string;
}