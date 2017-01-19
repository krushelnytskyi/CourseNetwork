<?php

namespace MVC\Controllers;

use System\ErrorHandler;
use System\View;

/**
 * Class Error
 * @package MVC\Controllers
 */
class Error extends Abstraction\Front
{

    /**
     * @return View
     */
    public function notFoundAction()
    {
        return new View('errors/404');
    }

    /**
     * @return View
     */
    public function errorAction()
    {
        $view = new View('errors/500');
        $view->assign('errorMessage', ErrorHandler::errorMessage());

        return $view;
    }



}