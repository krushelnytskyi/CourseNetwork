<?php

namespace MVC\Controllers;

use System\View;

class Home extends Abstraction\Front
{

    public function indexAction()
    {
        return new View('home/index');
    }
}