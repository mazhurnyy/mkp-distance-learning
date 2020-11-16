<?php


namespace lesha724\DistanceLearning\throws;

/**
 * Class NullArgumentException
 * @package lesha724\DistanceLearning\throws
 */
class NullArgumentException extends Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'NullArgumentException';
    }
}