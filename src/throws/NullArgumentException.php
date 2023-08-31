<?php


namespace mazhurnyy\DistanceLearning\throws;

/**
 * Class NullArgumentException
 * @package mazhurnyy\DistanceLearning\throws
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