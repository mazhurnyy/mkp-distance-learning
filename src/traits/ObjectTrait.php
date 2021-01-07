<?php

namespace lesha724\DistanceLearning\traits;

/**
 * Trait ObjectTrait
 * @package lesha724\DistanceLearning\traits
 */
trait ObjectTrait
{
    protected static $_attributes = [];

    /**
    * Sets the attribute values in a massive way.
    * @param object|array $values attribute values (name => value) to be assigned to the model.
    */
    public function setAttributes($values) : void
    {
        $attributes = $this->attributes();
        if(is_object($values))
        {
            foreach ($attributes as $attribute){
                if(isset($values->$attribute))
                    $this->$attribute = $values->$attribute;
            }
        }
        else if(is_array($values)) {
            $attributes = array_flip($attributes);
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    $this->$name = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        $class = new \ReflectionClass($this);
        $className = $class->getName();
        if(!empty(static::$_attributes[$className]))
            return static::$_attributes[$className];

        static::$_attributes[$className] = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                static::$_attributes[$className][] = $property->getName();
            }
        }

        return static::$_attributes[$className];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        $result = [];
        foreach ($this->attributes() as $attribute) {
            $result[$attribute] = $this->$attribute;
        }
        return $result;
    }
}