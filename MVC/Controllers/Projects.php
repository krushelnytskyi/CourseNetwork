<?php

namespace MVC\Controllers;

use MVC\Models\Project;
use MVC\Models\Freelancer;
use MVC\Models\Category;
use MVC\Models\Request;
use MVC\Models\User;
use System\Auth\Session;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;
use System\ORM\Criteria;
use System\ORM\Repository;

/**
 * Class Projects
 * @package MVC\Controllers
 */
class Projects extends Controller
{

    /**
     * function for created any list items
     * @param $model
     * @param $variablesName  string
     * @return object
     * @internal param string $class
     */
    public function listItems($model, $variablesName)
    {
        $repo = new Repository($model);
        $listItems = $repo->findAll();

        return $this->getView()->assign($variablesName, $listItems);
    }

    /**
     * @param $url
     * @param $model
     * @param $criteriaVariable
     * @param $view
     * @param string $variableName
     */
    public function detailItem($url, $model, $criteriaVariable, $view, $variableName = 'detail')
    {
        $url =  Connection::getInstance()->secureString($url);

        preg_match('/([0-9]+)/', $url, $matches);
        $id = (int)$matches[0];

        $repo = new Repository($model);
        $detail = $repo->findOneBy([$criteriaVariable => $id]);

        if(null !== $detail){
            $this->getView()->assign($variableName, $detail);
            $this->getView()->view($view);
        }else{
            $this->getView()->view('404');
        }
    }

    /**
     * Search Projects Action
     */
    public function searchAction()
    {
        $url = $_SERVER['REQUEST_URI'];

        $criteria = new Criteria(new Repository(Project::class));

        if (false === empty($_POST['search'])) {
            $like = '%' . $_POST['search'] . '%';

            $criteria
                ->whereLike('name', $like)
                ->_or()->whereLike('description', $like);
        }

        if (false === empty($_POST['category'])) {
            $criteria
                ->_and()->where('category', '=', $_POST['category']);
        }

        $repo = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->assign('projects', $criteria->getResult());
        $this->getView()->assign('countAll', 5);

        $this->getView()->view('projects/search');
    }

    /**
     * Detail project page
     */
    public function projectAction()
    {
        //$this->detailItem($_SERVER['REQUEST_URI'], Project::class, 'id', 'projects/project', 'project');
        $url =  Connection::getInstance()->secureString($_SERVER['REQUEST_URI']);

        preg_match('/\/projects\/project\/([0-9]+)/', $url, $matches);
        $id = (int)$matches[1];

        $repo = new Repository(Project::class);
        $project = $repo->findOneBy(['id' => $id]);

        if(null === $project)
        {
            $this->getView()->view('404');
        }
        else
        {
            $repoProposals = new Repository(Request::class);
            $proposals = $repoProposals->findBy(['projectId' => $id]);

            if(null !== $proposals)
            {
                $this->getView()->assign('proposals', $proposals);
            }else{
                $this->getView()->assign('errorProposals', 'You might be first who send proposal');
            }
        }

        if(UserSession::getInstance()->getIdentity() !== null)
        {
            $role = UserSession::getInstance()->getIdentity()->getRole();
        }

        if($role === User::ROLE_FREELANCER){
            $user =  UserSession::getInstance()->getIdentity()->getId();

            $repoFreelancer = new Repository(Freelancer::class);
            $freelancerModel = $repoFreelancer->findOneBy(['user'=>$user]);

            if((int)$freelancerModel->getRequestBalance() > 0)
            {
                $this->getView()->assign('freelancer', $freelancerModel);
            }else{
                $this->getView()->assign('errorUser', 'Ended proposals on the balance');
            }
        }else{
            $this->getView()->assign('errorUser', 'Only freelancers can send proposals');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $rate = (float)Connection::getInstance()->secureString($_POST['rate']);
            $deadline = (int)Connection::getInstance()->secureString($_POST['deadline']);
            $description = Connection::getInstance()->secureString($_POST['description']);

            $repoProposals = new Repository(Request::class);
            $proposals = new Request();

            $projectId = (int)$project->getId();
            $freelancerId = (int)$freelancerModel->getId();

            $proposals->setRate($rate);
            $proposals->setDeadline($deadline);
            $proposals->setRequestText($description);
            $proposals->setProjectId($projectId);
            $proposals->setFreelancerId($freelancerId);

            $countProposals = (int)$project->getRequestsCount()+1;
            $countBalance = (int)$freelancerModel->getRequestBalance()-1;

            $project->setRequestsCount($countProposals);
            $freelancerModel->setRequestBalance($countBalance);

            $repoProposals->save($proposals);
            $repo->save($project, 'id', $id);
            $repoFreelancer->save($freelancerModel,'user_id', $user);

            $_POST = array();
        }

        $this->getView()->assign('project', $project);
        $this->getView()->view('projects/project');
    }

    /**
     * Project Request action
     */
    public function requestAction(){

//        if(null !== UserSession::getInstance()->getReferer()){
//            $url_referer = $_SERVER['HTTP_REFERER']; //request
//            $url_origin = UserSession::getInstance()->getReferer(); //1
//
//            preg_match_all('/\d+/', $url_origin, $matches); //1
//            $id_origin = (int)$matches[0];
//
//            preg_match_all('/\d+/', $url_referer, $matches); //0
//            $id_referer = (int)$matches[0];
//
//            if($id_origin !== null && $id_referer !== null && $id_origin !== $id_referer)
//            {
//                UserSession::getInstance()->clearReferer();
//                UserSession::getInstance()->saveReferer();
//            }
//        }
//        else
//        if((preg_match('/\/projects\/project\/([0-9]+)/', $_SERVER['HTTP_REFERER'])) === 1)
//        {
//            UserSession::getInstance()->saveReferer();
//            $url = UserSession::getInstance()->getReferer();
//
//            var_dump($url);
//            exit(0);
//        }

//        var_dump($url);
//        exit(0);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
//            $url = UserSession::getInstance()->getReferer();
//            $url =  Connection::getInstance()->secureString($url);
//
//            if(preg_match('/\/projects\/request\//', $_SERVER['HTTP_REFERER']) === 1){
//
//                var_dump($url);
//                exit(0);

//                preg_match_all('/\d+/', $url, $matches);
//                $id = (int)$matches[0];
            $id = 1;

                $repo = new Repository(Project::class);
                $project = $repo->findOneBy(['id' => $id]);

                $freelancer = UserSession::getInstance()->getIdentity();

                if($freelancer !==null ){

                    $role = $freelancer->getRole();

                    if($role === User::ROLE_FREELANCER){
                        $freelancer_id = (int)$freelancer->getId();

                        $rate = Connection::getInstance()->secureString($_POST['rate']);
                        $deadline = Connection::getInstance()->secureString($_POST['deadline']);
                        $description = Connection::getInstance()->secureString($_POST['description']);

                        $repoRequest = new Repository(Request::class);
                        $request = new Request();

                        $repoFreelancer = new Repository(Freelancer::class);
                        $freelancerModel = $repoFreelancer->findOneBy(['user'=>$freelancer_id]);

                        $request->setRate($rate);
                        $request->setDeadline($deadline);
                        $request->setRequestText($description);
                        $request->setProjectId($id);
                        $request->setFreelancerId($freelancer_id);

//                        echo '<pre>';
//                        var_dump($freelancerModel);
//                        var_dump($request);
//                        exit(0);
//                        echo '</pre>';

                        $countProposals = $project->getRequestsCount()+1;
                        $countBalance = $freelancerModel->getRequestBalance()-1;

                        $project->setRequestsCount($countProposals);
                        $freelancerModel->setRequestBalance($countBalance);

                        $repoRequest->save($request);
                        $repo->save($project, 'id', $id);
                       // $repoFreelancer->save($freelancerModel,'user', $freelancer_id);

                        $this->forward('/projects/project/'.$id);
                        //$this->forward($url);
                    }else{
                        $this->getView()->assign('error', 'Only freelancers can send proposals');
                    }

                }else{
                    $this->getView()->assign('error', 'You must be authorized as freelancer for created projects');
                }
//            }
//            else{
//                $this->forward('projects/search');
//            }

        }else{

            $this->getView()->view('projects/request');
        }

    }

    /**
     * Category page action
     */
    public function categoryAction()
    {
        $repo = new Repository(Project::class);
        $projectsAll = $repo->findAll();

        $repoCategories = new Repository(Category::class);
        $categories = $repoCategories->findAll();

        $countAll = count($projectsAll);

        $url =  Connection::getInstance()->secureString($_SERVER['REQUEST_URI']);

        preg_match_all('/\d+/', $url, $matches);
        $id = (int)$matches[0];

        if(null !== $id)
        {
            $category = $repoCategories->findOneBy(['id' => $id]);
            if(null !== $category){
                $projects = $repo->findBy(['category'=>$id]);
                $this->getView()->assign('projects', $projects);
                $this->getView()->assign('categories', $categories);
                $this->getView()->assign('countAll', $countAll);
                $this->getView()->view('projects/category');
            }else{
                $this->getView()->view('404');
            }
        }
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

               if($role === User::ROLE_CUSTOMER){
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

                   $this->redirect('projects/search');
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
