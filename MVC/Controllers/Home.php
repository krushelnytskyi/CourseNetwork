<?php

namespace MVC\Controllers;

use System\Controller;

class Home extends Controller
{

    public function indexAction()
    {
        if (true) {
            // redirect -> users/login           http://www.internet-technologies.ru/articles/article_2205.html
        }

        $this->getView()->view('home/index');
    }
}