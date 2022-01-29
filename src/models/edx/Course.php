<?php

namespace lesha724\DistanceLearning\models\edx;

use lesha724\DistanceLearning\interfaces\ICourse;
use lesha724\DistanceLearning\models\BaseObject;

/**
 * Моделька для курсов из edx
 * Class Course
 * @package lesha724\DistanceLearning\models
 */
class Course extends BaseObject implements ICourse
{
    /**
     * @var int
     */
    public $course_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $short_description;

    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $end;

    #region Methods
    /**
     * Код курса
     * @return int
     */
    public function getId(): int
    {
        return $this->course_id;
    }

    /**
     * Дата начала курса
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->start;
    }

    /**
     * Дата окончания курса
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->end;
    }

    /**
     * Название
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Короткое описание
     * @return string
     */
    public function getDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return '';
    }
    #endregion
}