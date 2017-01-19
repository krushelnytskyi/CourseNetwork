<?php

namespace System;

/**
 * Class Controller
 * @package System
 */
abstract class Controller
{

    /**
     * @var
     */
    protected $layout;

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize controller method
     */
    public function init()
    {
    }

    /**
     * @param $url
     */
    public function forward($url)
    {
        Dispatcher::getInstance()->dispatch($url);
        exit(0);
    }

}