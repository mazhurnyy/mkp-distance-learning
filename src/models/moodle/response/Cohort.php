<?php

namespace lesha724\DistanceLearning\models\moodle\response;

use lesha724\DistanceLearning\models\BaseObject;

/**
 * когорта
 * Class Cohort
 * @package lesha724\DistanceLearning\models\moodle
 */
class Cohort extends BaseObject
{
    public $id;

    //cohort name
    public $name;

    //cohort idnumber
    public $idnumber;

    //description
    public $description;

    //description format (1 = HTML, 0 = MOODLE, 2 = PLAIN or 4 = MARKDOWN)
    public $descriptionformat = 1;

    //cohort visible
    public $visible = 1;
}