<?php


namespace lesha724\DistanceLearning\interfaces;

/**
 * Интерфейс для курсов
 * Interface ICourse
 * @package lesha724\DistanceLearning\interfaces
 */
interface ICourse
{
    public function getId() : int;

    public function getName() : string;

    public function getDescription() : string;

    /**
     * @return string|false
     */
    public function getStartDate();

    /**
     * @return string|false
     */
    public function getEndDate();
    
    public function getUrl() : string;
}