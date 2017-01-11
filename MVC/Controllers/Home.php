<?php

namespace MVC\Controllers;

use System\Dispatcher;

class Home
{

    public function indexAction()
    {
        Dispatcher::getInstance()->display('home/index');
    }

}