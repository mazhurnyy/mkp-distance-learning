<?php


namespace lesha724\DistanceLearning\throws;

/**
 * Class Exception
 * @package lesha724\DistanceLearning\throws
 */
class Exception extends \Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'Exception';
    }
}