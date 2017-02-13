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
    const ORIGIN_URL = 'originUrl';

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

    /**
     * Save origin http referer
     * @return string
     */
    public function saveReferer()
    {
        $_SESSION[static::ORIGIN_URL] = $_SERVER[static::ORIGIN_URL];

    }

    /**
     * @return string|null
     */
    public function getReferer()
    {
        return $_SESSION[static::ORIGIN_URL];
    }

    /*
     * Clear origin http referer after use
     */
    public function clearReferer()
    {
        $_SESSION[static::ORIGIN_URL] = null;
    }
}

