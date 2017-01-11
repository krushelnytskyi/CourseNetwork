<?php

namespace MVC\Controllers;

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

}