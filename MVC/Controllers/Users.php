<?php

namespace MVC\Controllers;

use System\Dispatcher;
use PDO;

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
    	try {
    		$dsn = 'mysql:host=127.0.0.1;dbname=mysql;charset=utf8';
    		$pdo = new PDO($dsn, 'root', '');
    	} catch (PDOException $e) {
    		die($e->getMessage());
    	}
    	
    	$file = APP_ROOT . 'config/database/version_1.sql';
    	
    	if( file_exists($file) == true ) {
    		$file = implode(' ', file( $file ));
    		$patern[0] = '/(\/\*.*)/' ;
    		$query = trim(preg_replace($patern, '', $file));
    		
    		$query = $pdo->prepare($query);
    		$query->execute();
    	}
    	    	 
        //Dispatcher::getInstance()->display('users/login');
    }

    /**
     * Register action
     */
    public function registerAction()
    {
        Dispatcher::getInstance()->display('users/register');
    }

}