<?php

namespace System;
use System\Auth\UserSession;
use MVC\Models\User;
abstract class Controller
{

    public function initial()
    {
    }

    /**
     * @return View
     */
    public function getView()
    {
        return View::getInstance();
    }

    public function forward($url)
    {
        Dispatcher::getInstance()->dispatch($url);
        exit(0);
    }

    public function redirect($url)
    {
        header('Location: /' . $url);
        exit(0);
    }

}