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
     * $_SESSION key constant
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
        return isset($_SESSION[static::IDENTITY]);
    }

    /**
     * @param $identity
     */
    public function setIdentity($identity)
    {
        $_SESSION[static::IDENTITY] = $identity;
    }

    /**
     * @return null|string
     */
    public function getIdentity()
    {
        return $_SESSION[static::IDENTITY];
    }

    /**
     * Clear identity
     */
    public function clearIdentity()
    {
        session_unset();
    }
}

