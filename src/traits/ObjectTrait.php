<?php


namespace lesha724\DistanceLearning\traits;

/**
 * Trait ObjectTrait
 * @package lesha724\DistanceLearning\traits
 */
trait ObjectTrait
{
    /**
    * Sets the attribute values in a massive way.
    * @param array $values attribute values (name => value) to be assigned to the model.
    */
    public function setAttributes(array $values)
    {
        foreach ($values as $name => $value) {
            if (isset($attributes[$name])) {
                $this->$name = $value;
            }
        }
    }
}