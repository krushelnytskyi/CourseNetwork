<?php

namespace MVC\Controllers;

use MVC\Models\Freelancer;
use MVC\Models\User;
use MVC\Models\Category;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;
use System\ORM\Repository;

/**
 * Class Freelancers
 * @package MVC\Controllers
 */
class Freelancers extends Controller
{

    /**
     * Search Projects Action
     */
    public function searchAction()
    {
        $repo           = new Repository(Freelancer::class);
        $freelancersAll = $repo->findAll();
        $countAll       = count($freelancersAll);

        $url = Connection::getInstance()->secureString($_SERVER['REQUEST_URI']);


        if (preg_match('/\/freelancers\/category\/([0-9]+)/', $url, $matches)) {
            $id          = (int) $matches[1];
            $freelancers = $repo->findBy(['category' => $id]);
        }
        else {
            $freelancers = $freelancersAll;
        }
        $repo       = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->assign('freelancers', $freelancers);
        $this->getView()->assign('countAll', $countAll);

        $this->getView()->view('freelancers/search');
    }

    /**
     * Detail profile page Action
     */
    public function profileAction()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        list(,,$id) = explode('/', $url);

        $repo       = new Repository(Freelancer::class);
        $freelancer = $repo->findOneBy(['id' => $id]);

        $this->getView()->assign('freelancer', $freelancer);

        if ($freelancer === null) {
            $this->getView()->view('404');
        }
        else {
            $this->getView()->view('freelancers/profile');
            $this->getView()->assign('freelancer', $freelancer);
        }
    }

}
