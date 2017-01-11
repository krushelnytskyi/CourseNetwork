<?php

namespace MVC\Controllers;

use System\Config;
use System\Dispatcher;

/**
 * Class Users
 * @package MVC\Controllers
 */
class Users
{

    /**
     * Login action
     */
    public function loginAction()
    {
        Dispatcher::getInstance()->display('users/login');
    }

    /**
     * Register action
     */
    public function registerAction()
    {
        Dispatcher::getInstance()->display('users/register');
    }

    public function testAction()
    {
        $dbHost
            = Config::getInstance()->get('database', 'host', 'localhost');
        var_dump($dbHost);
    }

}