<?php

namespace MVC\Controllers;

use System\MVC\Controllers\BaseController;

class Home extends BaseController
{

    public function indexAction()
    {
        $this->forward('users/login');
    }

}