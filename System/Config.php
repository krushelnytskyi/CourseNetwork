<?php

namespace System;

use System\Pattern\Singleton;

/**
 * Class Config
 * @package System
 *
 * @method static Config getInstance()
 */
class Config
{
    use Singleton;

    /**
     * @param string        $config
     * @param string|array  $key
     * @param null          $default
     *
     * @return array|string|null
     */
    public function get($config, $key = [], $default = null)
    {
        $file = APP_ROOT . 'config/' . $config . '.php';

        if (file_exists($file) === false) {
            return $default;
        }

        $configValues = include $file;

        $userFile = APP_ROOT . 'config/user/' . $config . '.php';

        if (file_exists($userFile) === true) {
            $configValues = array_replace_recursive(
                $configValues,
                include $userFile
            );
        }

        $key = (array)$key;

        foreach ($key as $innerKey) {
            if (isset($configValues[$innerKey]) === true) {
                $configValues = $configValues[$innerKey];
            } else {
                return $default;
            }
        }

        return $configValues;
    }

}