<?php

namespace System\Auth;

use System\Pattern\Singleton;

/**
 * Class Session
 * @package System\Auth
 *
 * @method static Session getInstance()
 */
class Session
{

    /**
     * Session offset
     */
    const IDENTITY = 'IDENTITY';

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
        return true === isset($_SESSION[static::IDENTITY]);
    }

    public function setIdentity($identity)
    {
        $_SESSION[static::IDENTITY] = $identity;
    }

    /**
     * @return null
     */
    public function getIdentity()
    {
        if ($this->hasIdentity() === true) {
            return $_SESSION[static::IDENTITY];
        } else {
            return null;
        }
    }

    /**
     * Destroying session
     */
    public function clearIdentity()
    {
        session_destroy();
    }
}
