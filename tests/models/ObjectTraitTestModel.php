<?php

namespace mazhurnyy\DistanceLearning\tests\models;

use mazhurnyy\DistanceLearning\traits\ObjectTrait;

/**
 * Class ObjectTraitTestModel
 * @package mazhurnyy\DistanceLearning\tests\models
 *
 * @see
 */
class ObjectTraitTestModel
{
    use ObjectTrait;

    public $field1 = 'default1';

    public $field2 = 'default2';

    public $field3 = 'default3';

    protected $field4 = 'default4';

    private $field5 = 'default5';

    public function getField4(): string
    {
        return $this->field4;
    }

    public function getField5(): string
    {
        return $this->field5;
    }
}