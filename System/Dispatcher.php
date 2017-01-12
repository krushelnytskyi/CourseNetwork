<?php

namespace System;

/**
 * Class Dispatcher
 * @package System
 */
class Dispatcher
{

    /**
     * @var Dispatcher|null
     */
    private static $instance;

    /**
     * @return null|Dispatcher
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function dispatch()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        
        // users/login
        list($controller, $action) = explode('/', $url);
		
        $controller = 'MVC\Controllers\\' . ucfirst($controller);

        if (class_exists($controller) === true) {
            $controller = new $controller();

            $action = $action . 'Action';

            if (method_exists($controller, $action)) {
                $controller->$action();
            }
        }
    }

    public function display($viewPath)
    {
        $realPath = APP_ROOT . 'MVC/Views/' . $viewPath . '.phtml';

        ob_start();

        if (file_exists($realPath) === true) {
            include_once $realPath;
        } else {
            include_once APP_ROOT . 'MVC/Views/404.phtml';
        }

        $viewContent = ob_get_clean();

        include_once APP_ROOT . 'MVC/Layout/main.phtml';
    }
}
