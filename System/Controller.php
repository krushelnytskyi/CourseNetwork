<?php

namespace System;

abstract class Controller
{

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

}