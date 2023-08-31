<?php

namespace mazhurnyy\DistanceLearning\models\moodle\request;

use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Class Group
 * @package mazhurnyy\DistanceLearning\models\moodle\request
 */
class Group extends BaseObject
{
    public $name;
    
    public $courseid;

    public $description;

    public $enrolmentkey;

    public $idnumber;
}