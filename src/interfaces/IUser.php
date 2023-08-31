<?php


namespace mazhurnyy\DistanceLearning\interfaces;

/**
 * Interface IUser
 * @package mazhurnyy\DistanceLearning\interfaces
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