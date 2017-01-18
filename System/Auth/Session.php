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
    public function hasIdentity()
    {
    }

    public function setIdentity($identity)
    {
        $_SESSION[''] = $identity;
    }

    public function getIdentity()
    {
    }

    public function clearIdentity()
    {
    }
}
