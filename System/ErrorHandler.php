<?php

namespace System;

/**
 * Class ErrorHandler
 * @package System
 *
 */
class ErrorHandler
{

    /**
     * @var string
     */
    private static $errorMessage = 'Undefined error';

    /**
     * @param null|string $message
     * @return string
     */
    public static function errorMessage($message = null)
    {
        if ($message !== null) {
            static::$errorMessage = $message;
        }

        return static::$errorMessage;
    }

    /**
     * @param $name
     * @param $arguments
     * @return null
     */
    public static function __callStatic($name, $arguments)
    {
        $function = Config::getInstance()->get('handles', ['errors', $name]);
        return is_callable($function) ? call_user_func($function) : null;
    }

}