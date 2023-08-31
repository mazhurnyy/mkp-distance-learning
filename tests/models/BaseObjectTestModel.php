<?php

namespace mazhurnyy\DistanceLearning\tests\models;

use mazhurnyy\DistanceLearning\models\BaseObject;
use mazhurnyy\DistanceLearning\tests\BaseObjectTest;

/**
 * Class BaseObjectTestModel
 * @package mazhurnyy\DistanceLearning\tests\models
 *
 * @see BaseObjectTest
 */
class BaseObjectTestModel extends BaseObject
{
    public $field1 = 'default1';

    public $field2 = 'default2';

    public $field3 = 'default3';

    protected $field4 = 'default4';

    public function getField4(): string
    {
        return $this->field4;
    }
}