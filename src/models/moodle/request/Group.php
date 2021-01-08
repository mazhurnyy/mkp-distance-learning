<?php

namespace lesha724\DistanceLearning\models\moodle\request;

use lesha724\DistanceLearning\models\BaseObject;

/**
 * Class Group
 * @package lesha724\DistanceLearning\models\moodle\request
 */
class Group extends BaseObject
{
    public $name;
    
    public $courseid;

    public $description;

    public $enrolmentkey;

    public $idnumber;
}