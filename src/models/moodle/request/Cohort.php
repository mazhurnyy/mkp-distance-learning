<?php

namespace mazhurnyy\DistanceLearning\models\moodle\request;

use mazhurnyy\DistanceLearning\models\BaseObject;

/**
 * Запрос для создания когорты
 * Class Cohort
 * @package mazhurnyy\DistanceLearning\models\moodle\request
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

    public $categorytype = [
        'type' => 'system',
        'value' => ''
    ];
}