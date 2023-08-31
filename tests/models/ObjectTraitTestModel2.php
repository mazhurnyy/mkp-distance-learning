<?php

namespace mazhurnyy\DistanceLearning\tests\models;

use mazhurnyy\DistanceLearning\traits\ObjectTrait;

/**
 * Class ObjectTraitTestModel2
 * @package mazhurnyy\DistanceLearning\tests\models
 *
 * @see
 */
class ObjectTraitTestModel2
{
    use ObjectTrait;

    private $field1 = 'default1';

    protected $field2 = 'default2';

    public $field3 = 'default3';

    public $field4 = 'default4';
}