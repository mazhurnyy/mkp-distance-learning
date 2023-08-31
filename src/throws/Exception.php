<?php


namespace mazhurnyy\DistanceLearning\throws;

/**
 * Class Exception
 * @package mazhurnyy\DistanceLearning\throws
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