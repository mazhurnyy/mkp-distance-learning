<?php

namespace mazhurnyy\DistanceLearning\models\moodle\response;

use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Class Group
 * @package mazhurnyy\DistanceLearning\models\moodle\response
 */
class Group extends BaseObject
{
    public $id;

    public $courseid;

    public $description;

    public $enrolmentkey;

    public $idnumber;
}