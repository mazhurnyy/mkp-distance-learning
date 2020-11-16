<?php


namespace lesha724\DistanceLearning\interfaces;

/**
 * Интерфейс для студента
 * Interface IStudent
 * @package lesha724\DistanceLearning\interfaces
 */
interface IStudent
{
    /**
     * Полное имя
     * @return string
     */
    public function getFullName() : string;

    /**
     * код студента
     * @return int
     */
    public function getId() : int;

    /**
     * код студента во внешней системе
     * @return int
     */
    public function getExternalId() : int;
}