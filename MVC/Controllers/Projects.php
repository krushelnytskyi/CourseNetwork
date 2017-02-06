<?php

namespace MVC\Controllers;

use MVC\Models\Project;
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
        $repo = new Repository(Project::class);
        $projects = $repo->findAll();

        $this->getView()->assign('projects', $projects);
        $this->getView()->view('projects/search');
    }

    /**
     * Create Project Action
     */
    public function createAction()
    {
        $repo = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->view('projects/create');
    }

    /**
     *  Create Project Action
     */
    public function createProjectAction(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = $_POST['name'];
            $description = $_POST['description'];
            $workType = $_POST['work-type'];
            $budget = $_POST['budget'];
            $category = $_POST['category'];
            $customer = \System\Auth\UserSession::getInstance()->getIdentity()->getId();
            //$customer = $_SESSION['id'];

            $repo = new Repository(Project::class);
            $project = new Project();
            $project->setName($name);
            $project->setDescription($description);
            $project->setWorkType($workType);
            $project->setBudget($budget);
            $project->setCategory($category);
            $project->setCustomer($customer);

            $repo->save($project);
            $this->forward('projects/search');
        }
    }
}
