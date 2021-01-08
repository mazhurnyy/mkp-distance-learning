<?php

namespace lesha724\DistanceLearning\tests;

use lesha724\DistanceLearning\tests\models\ObjectTraitTestModel;
use lesha724\DistanceLearning\tests\models\ObjectTraitTestModel2;
use lesha724\DistanceLearning\traits\ObjectTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ObjectTraitTest
 * @package lesha724\DistanceLearning\tests
 *
 * @see ObjectTrait
 */
class ObjectTraitTest extends TestCase
{
    /**
     * получения полей со значениями
     *
     * @see ObjectTrait::getAttributes()
     */
    public function testGetAttributes() {
        $this->assertEquals(
            [
                'field1' => 'default1',
                'field2' => 'default2',
                'field3' => 'default3'
            ],
            (new ObjectTraitTestModel())->getAttributes()
        );

        $this->assertEquals(
            [
                'field3' => 'default3',
                'field4' => 'default4'
            ],
            (new ObjectTraitTestModel2())->getAttributes()
        );
    }

    /**
     * получения списка полей
     *
     * @see ObjectTrait::attributes()
     */
    public function testAttributes() {
        $this->assertEquals(
            [
                'field1',
                'field2',
                'field3'
            ],
            (new ObjectTraitTestModel())->attributes()
        );

        $this->assertEquals(
            [
                'field3',
                'field4'
            ],
            (new ObjectTraitTestModel2())->attributes()
        );
    }

    /**
     * Создание объекта на основе массива
     */
    public function testSetAttributesWithArray()
    {
        $model = new ObjectTraitTestModel();
        $model->setAttributes([
            'field1' => '1',
            'field2' => '2',
            'field4' => '4',
            'field5' => '5'
        ]);

        $this->assertEquals('1', $model->field1);
        $this->assertEquals('2', $model->field2);
        //тест значения не заданного поля
        $this->assertEquals('default3', $model->field3);
        //тест значения поля protected
        $this->assertEquals('default4', $model->getField4());
        //тест значения поля private
        $this->assertEquals('default5', $model->getField5());
    }

    /**
     * Создание объекта на основе другого объекта
     */
    public function testSetAttributesWithObject()
    {
        $obj = new \stdClass();
        $obj->field1 =  '1';
        $obj->field2 = '2';
        $obj->field4 = '4';
        $obj->field5 = '5';

        $model = new ObjectTraitTestModel();
        $model->setAttributes($obj);

        $this->assertEquals('1', $model->field1);
        $this->assertEquals('2', $model->field2);
        //тест значения не заданного поля
        $this->assertEquals('default3', $model->field3);
        //тест значения поля protected
        $this->assertEquals('default4', $model->getField4());
        //тест значения поля private
        $this->assertEquals('default5', $model->getField5());
    }
}