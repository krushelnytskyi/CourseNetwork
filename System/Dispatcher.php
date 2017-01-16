<?php

namespace System;

use System\Pattern\Singleton;

/**
 * Class Dispatcher
 * @package System
 *
 * @method static Dispatcher getInstance()
 */
class Dispatcher
{
    use Singleton;

    public function dispatch()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        
        // users/login
        $urlParts = explode('/', $url);
        
        if (true === isset($urlParts[0])) {
        	$controller = $urlParts[0];
        }

        if (true === isset($urlParts[1])) {
        	$action = $urlParts[1];
        }
        
        $controller = 'MVC\Controllers\\' . ucfirst($controller);

        foreach (Config::getInstance()->get('routes', 'urls') as $configUrl => $rule) {
            if ($url === $configUrl) {
                $controller = $rule['controller'];
                $action = $rule['action'];
            }
        }

        foreach (Config::getInstance()->get('routes', 'patterns') as $pattern => $rule) {
            if (preg_match('/' . $pattern . '/', $url) === 1) {
                $controller = preg_replace('/' . $pattern . '/', $rule['controller'], $url);
                $action = preg_replace('/' . $pattern . '/', $rule['action'], $url);
            }
        }

        $action = $action . 'Action';

        if (class_exists($controller) === true && method_exists($controller, $action)) {
            $controller = new $controller();
            $controller->$action();
        } else {
            $this->handleNotFound();
        }
    }

    public function display($viewPath)
    {
        $realPath = APP_ROOT . 'MVC/Views/' . $viewPath . '.phtml';

        ob_start();

        if (file_exists($realPath) === true) {
            include_once $realPath;
        } else {
            $this->handleNotFound();
        }

        $viewContent = ob_get_clean();

        include_once APP_ROOT . 'MVC/Layout/main.phtml';
    }

    /**
     * Include 404.phtml view
     */
    public function handleNotFound()
    {
        $this->display('404');
    }
}
