<?php


namespace lesha724\DistanceLearning\tests;


use lesha724\DistanceLearning\models\BaseObject;
use lesha724\DistanceLearning\tests\models\BaseObjectTestModel;
use lesha724\DistanceLearning\traits\ObjectTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class BaseObjectTest
 * @package lesha724\DistanceLearning\tests
 *
 * @see BaseObject
 */
class BaseObjectTest extends TestCase
{
    /**
     * Создание объекта на основе массива
     */
    public function testConstructorWithArray()
    {
        $model = new BaseObjectTestModel([
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
        //тест не существующего поля
        $this->assertFalse(isset($model->field5));
    }

    /**
     * Создание объекта на основе другого объекта
     */
    public function testConstructorWithObject()
    {
        $obj = new \stdClass();
        $obj->field1 =  '1';
        $obj->field2 = '2';
        $obj->field4 = '4';
        $obj->field5 = '5';

        $model = new BaseObjectTestModel($obj);

        $this->assertEquals('1', $model->field1);
        $this->assertEquals('2', $model->field2);
        //тест значения не заданного поля
        $this->assertEquals('default3', $model->field3);
        //тест значения поля protected
        $this->assertEquals('default4', $model->getField4());
        //тест не существующего поля
        $this->assertFalse(isset($model->field5));
    }

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
            (new BaseObjectTestModel())->getAttributes()
        );
    }
}