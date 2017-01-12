<?php

namespace System\MVC\Controllers;

use System\Dispatcher;
use System\View;

/**
 * Class BaseController
 * @package System\MVC\Controllers
 */
class BaseController
{
    /**
     * @return null|object
     */
    public function getView()
    {
        return View::getInstance();
    }

    /**
     * @param $url
     */
    public function forward($url)
    {
        Dispatcher::getInstance()->dispatch($url);
    }

}