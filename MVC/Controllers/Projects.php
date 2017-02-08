<?php

namespace MVC\Controllers;

use MVC\Models\Project;
use MVC\Models\Category;
use MVC\Models\User;
use System\Auth\Session;
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
     * function for created any list items
     * @param $class          string
     * @param $variablesName  string
     * @return                object
     */
   /* public function listItems($class, $variablesName){
        $repo = new Repository($class::class);
        $listItems = $repo->findAll();

        return $this->getView()->assign($variablesName, $listItems);
    }*/

    /**
     * Search Projects Action
     */
    public function searchAction()
    {
        $repo = new Repository(Project::class);
        $projectsAll = $repo->findAll();
        $countAll = count($projectsAll);

        if(isset($_GET['category']) && null !== $_GET['category'])
        {
            $projects = $repo->findBy(['category'=>$_GET['category']]);
        }else{
            $projects = $projectsAll;
        }

        $repo = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->assign('projects', $projects);
        $this->getView()->assign('countAll', $countAll);

       // $this->listItems('Project', 'projects');
        $this->getView()->view('projects/search');
    }

    /**
     * view create project form
     */
    private function projectCreateView(){
        $repo = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->view('projects/create');
    }

    /**
     * Create Project Action
     */
    public function createAction()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

           $customer = UserSession::getInstance()->getIdentity();

           if($customer!==null){

               $role = $customer->getRole();

               if($role === 'customer'){
                   $customer = $customer->getId();

                   $name = Connection::getInstance()->secureString($_POST['name']);
                   $description = Connection::getInstance()->secureString($_POST['description']);
                   $workType = Connection::getInstance()->secureString($_POST['work-type']);
                   $budget = Connection::getInstance()->secureString($_POST['budget']);
                   $categoryId = Connection::getInstance()->secureString($_POST['category']);

                   $repo = new Repository(Project::class);
                   $repoCategory = new Repository(Category::class);

                   $project = new Project();
                   $category = $repoCategory->findOneBy(['id' => $categoryId]);

                   $project->setName($name);
                   $project->setDescription($description);
                   $project->setWorkType($workType);
                   $project->setBudget($budget);
                   $project->setCategory($categoryId);
                   $project->setCustomer($customer);

                   $countProjects = $category->getCount()+1;

                   $category->setCount($countProjects);

                   $repo->save($project);
                   $repoCategory->save($category, 'id', $categoryId);

                   $this->forward('projects/search');
               }else{
                   $this->getView()->assign('error', 'Only customers can create project');
               }

            }else{
                $this->getView()->assign('error', 'You must be authorized as customer for created projects');
            }

            $this->projectCreateView();

        }else {
            $this->projectCreateView();
        }
    }
}
