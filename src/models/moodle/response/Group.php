<?php

namespace lesha724\DistanceLearning\models\moodle\response;

use lesha724\DistanceLearning\models\BaseObject;

/**
 * Class Group
 * @package lesha724\DistanceLearning\models\moodle\response
 */
class Group extends BaseObject
{
    public $id;

    public $courseid;

    public $description;

    public $enrolmentkey;

    public $idnumber;
}