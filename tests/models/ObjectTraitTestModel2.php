<?php

namespace lesha724\DistanceLearning\tests\models;

use lesha724\DistanceLearning\traits\ObjectTrait;

/**
 * Class ObjectTraitTestModel2
 * @package lesha724\DistanceLearning\tests\models
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