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
}