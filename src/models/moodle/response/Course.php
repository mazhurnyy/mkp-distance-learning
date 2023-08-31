<?php

namespace mazhurnyy\DistanceLearning\models\moodle\response;

use mazhurnyy\DistanceLearning\interfaces\ICourse;
use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Моделька для курсов из moodle
 * Class Course
 * @package mazhurnyy\DistanceLearning\models\moodle
 */
class Course extends BaseObject implements ICourse
{
    #region props
    public $id;

    public $shortname;

    public $displayname;

    public $startdate;

    public $enddate;
    #endregion

    #region Methods
    /**
     * Код курса
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Дата начала курса
     * @return string|false
     */
    public function getStartDate()
    {
        return $this->_convertTimestampToString($this->startdate);
    }

    /**
     * Дата окончания курса
     * @return string|false
     */
    public function getEndDate()
    {
        return $this->_convertTimestampToString($this->enddate);
    }

    /**
     * Короткое название
     * @return string
     */
    public function getName(): string
    {
        return $this->shortname;
    }

    /**
     * Полное название
     * @return string
     */
    public function getDescription(): string
    {
        return $this->displayname;
    }

    /**
     * конвертация timestamp
     * @param int|string|null $timestamp
     * @return false|string
     */
    protected function _convertTimestampToString($timestamp) {
        if(empty($timestamp))
            return '';

        if(!is_int($timestamp))
            return $timestamp;

        return date('d.m.Y', $timestamp);
    }

    /**
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return '#';
    }
    #endregion
}