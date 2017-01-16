<?php

namespace MVC\Controllers;

use System\Controller;

class Home extends Controller
{

    public function indexAction()
    {
        if (true) {
            // redirect -> users/login
        }

        $this->getView()->view('home/index');
    }
}