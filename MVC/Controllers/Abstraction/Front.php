<?php

namespace MVC\Controllers\Abstraction;

use System\Config;
use System\Controller;

/**
 * Class Front
 * @package MVC\Controllers\Abstraction
 */
abstract class Front extends Controller
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setLayout(Config::getInstance()->get('app', 'default_layout'));
    }

}