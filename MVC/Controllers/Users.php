<?php

namespace MVC\Controllers;

use System\Config;
use System\Dispatcher;
use System\MVC\Controllers\BaseController;

/**
 * Class Users
 * @package MVC\Controllers
 */
class Users extends BaseController
{

    /**
     * Login action
     */
    public function loginAction()
    {
        $this->getView()->view('users/login');
    }

    /**
     * Register action
     */
    public function registerAction()
    {
        $this->getView()->view('users/register');
    }

}