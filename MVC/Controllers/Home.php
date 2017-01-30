<?php

namespace MVC\Controllers;

use System\Controller;

class Home extends Controller
{

    public function indexAction()
    {
        $this->getView()->view('home/index');
    }
}