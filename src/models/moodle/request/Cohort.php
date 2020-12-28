<?php

namespace lesha724\DistanceLearning\models\moodle\request;

use lesha724\DistanceLearning\models\BaseObject;

/**
 * Запрос для создания когорты
 * Class Cohort
 * @package lesha724\DistanceLearning\models\moodle\request
 */
class Cohort extends BaseObject
{
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