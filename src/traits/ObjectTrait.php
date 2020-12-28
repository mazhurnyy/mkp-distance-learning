<?php

namespace lesha724\DistanceLearning\traits;

/**
 * Trait ObjectTrait
 * @package lesha724\DistanceLearning\traits
 */
trait ObjectTrait
{
    protected static $_attributes;

    /**
    * Sets the attribute values in a massive way.
    * @param object|array $values attribute values (name => value) to be assigned to the model.
    */
    public function setAttributes($values)
    {
        $attributes = array_flip($this->attributes());
        if(is_object($values))
        {
            foreach ($attributes as $attribute){
                if(isset($values->$attribute))
                    $this->$attribute = $values->$attribute;
            }
        }
        if(is_array($values))
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    $this->$name = $value;
                }
            }
    }

    /**
     * @return array
     */
    public function attributes()
    {
        if(!empty($this::$_attributes))
            return $this::$_attributes;

        $class = new \ReflectionClass($this);
        $this::$_attributes = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $this::$_attributes[] = $property->getName();
            }
        }

        return $this::$_attributes;
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