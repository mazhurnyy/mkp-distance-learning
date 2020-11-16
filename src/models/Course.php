<?php

namespace lesha724\DistanceLearning\models;

/**
 * Моделька для курсов из внешней системы
 * Class Course
 * @package lesha724\DistanceLearning\models
 */
class Course extends BaseObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;
}