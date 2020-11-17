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

    public function getStartDate() : string;

    public function getEndDate() : string;
}