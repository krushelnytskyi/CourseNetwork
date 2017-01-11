<?php

namespace System\Pattern;

/**
 * Class Singleton
 * @package System
 */
trait Singleton
{

    /**
     * @var object|null
     */
    private static $instance;

    /**
     * @return null|object
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

}