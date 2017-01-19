<?php

namespace System\ORM;

/**
 * Class Model
 * @package System\ORM
 */
class Model
{

    /**
     * Model information constants
     */
    const STORAGE_NAME = null;

    /**
     * @return null|string
     */
    public function getStorageName()
    {
        return static::STORAGE_NAME;
    }

}