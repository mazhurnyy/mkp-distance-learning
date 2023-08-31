<?php


namespace mazhurnyy\DistanceLearning\throws;

/**
 * Class NotImplementedException
 * @package mazhurnyy\DistanceLearning\throws
 */
class NotImplementedException extends Exception
{
    /**
     * @return string the user-friendly name of this exception
     */
    public function getName()
    {
        return 'NotImplementedException';
    }

    /**
     * @var string
     */
    public $message = 'Метод не реализован.';
}