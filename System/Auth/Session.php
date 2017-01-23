<?php

namespace System\Auth;

use System\Pattern\Singleton;

/**
 * Class Session
 * @package System\Auth
 */
class Session
{

    use Singleton;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

	
    /**
     * @return bool $_SESSION['identity']
     */
    public function hasIdentity($login)
    {
		
		$hasIdentity = false;
		
		
		foreach ($_SESSION as $key => $value) {
			
			
			if ($value['login'] === $login) {
				
				$hasIdentity = true;
			}
			
			
		}
		return $hasIdentity;
		
    }
	
	
	
    /**
     * Set identity of session array into $_SESSION
	 * for a one user who entered
     */
    public function setIdentity($identity, $sessArr)
    {
		
		if ( ($identity !== null)&&($identity !== '')&&(is_array($sessArr)) ) {
			
		
		$_SESSION[$identity] = $sessArr;
		
     }
	 
    }
	
	
	
    /**
     * Return identity of session array
	 * for a one user with login $login 
     */
    public function getIdentity($login)
    {
		
		
		foreach ($_SESSION as $key => $value) {
			
			
			if ($value['login'] === $login) {
				
				return $key;
			}
			
			
		}
		
    }

	
	
	/**
     * Delete session for a one user with login $login 
	 * from superglobal array $_SESSION
     */
    public function clearIdentity($login)
    {
		
		$clearIdentity = false;
		
		
		foreach ($_SESSION as $key => $value) {
			
			
			if ($value['login'] === $login) {
				
		
				unset ($_SESSION[$key]);
				
				
				//if (count($_SESSION) == 0) { 
				
		        //session_destroy();
				
			     //}
				
				
				$clearIdentity = true;
				
			}
			
			
		}
	
		
		return $clearIdentity;
    }
	
	
}
