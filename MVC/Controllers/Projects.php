<?php

namespace MVC\Controllers;

use MVC\Models\Category;
use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;
use System\ORM\Repository;

/**
 * Class Projects
 * @package MVC\Controllers
 */
class Projects extends Controller
{
    /**
     * Search Projects Action
     */
    public function searchAction()
    {
        $this->getView()->view('projects/search');
    }

    /**
     * Create Project Action
     */
    public function createAction()
    {
        $repo = new Repository(Category::class);
        $this->getView()->assign('categories', $repo->findAll());
        $this->getView()->view('projects/create');
    }
}
