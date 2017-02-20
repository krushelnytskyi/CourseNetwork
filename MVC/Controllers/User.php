<?php

namespace MVC\Controllers;

use MVC\Models\Customer;
use MVC\Models\Portfolio;
use MVC\Models\User as UserModel;
use MVC\Models\Freelancer;
use MVC\Models\Project;
use MVC\Models\Category;
use System\Auth\Session;
use System\Auth\UserSession;
use System\Config;
use System\Controller;
use System\Database\Connection;
use System\ORM\Repository;

/**
 * Class Users
 * @package MVC\Controllers
 */
class User extends Controller
{

    /**
     * Login action
     */
    public function mainAction()
    {
        $this->getView()->view('user/main');
    }

    /**
     * view setting user form
     */
    private function userSettingView()
    {
        $repo       = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->view('user/setting');
    }

    /**
     * User Setting action
     */
    public function settingAction()
    {
        $user = \System\Auth\UserSession::getInstance()->getIdentity();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name       = $_POST['name'] ?: null;
            $email      = $_POST['login'] ?: null;
            $site       = $_POST['site'] ?: null;
            $phone      = $_POST['phone'] ?: null;
            $skype      = $_POST['skype'] ?: null;
            $categoryId = $_POST['category'] ?: null;
            $rate       = $_POST['rate'] ?: null;
            $password   = $_POST['password'] ?: null;
            $avatarName = $_POST['avatarName'] ?: null;
            $uploaddir  = APP_ROOT . 'assets/img/user-page/avatar/';
            $uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
            if (true === move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                $this->getView()->view('user/setting');
            }
            else {
                $this->getView()
                  ->assign('error', 'Upload avatar file');
            }

            $repo           = new Repository(UserModel::class);
            $repoFreelancer = new Repository(Freelancer::class);
            $repoCategory   = new Repository(Category::class);


            $subUser    = new UserModel();
            /** @var User $user */
            $subUser    = $repo->findOneBy([
              'id' => $user->getId()
            ]);
            $freelanser = new Freelancer();
            $category   = $repoCategory->findOneBy(['id' => $categoryId]);

            if ($password !== null) {
                $subUser->setPassword(User::hashPassword($password));
            }
            $subUser->setName($name);
            $subUser->setEmail($email);
            $subUser->setSite($site);
            $subUser->setPhone($phone);
            $subUser->setSkype($skype);
            $subUser->setAvatar($avatarName);
            $freelanser->setRate($rate);
            $freelanser->setCategory($category);

            $repo->save($subUser, 'id', $subUser->getId());
            $repo->save($freelanser);
            $repoCategory->save($category, 'id', $categoryId);

            $this->redirect('user/main');
            $this->userSettingView();
        }
        else {
            $this->userSettingView();
        }
    }

    /**
     * Register action
     */
    public function menuinfoAction()
    {
        $this->getView()->view('user/menuinfo');
    }

    public function portfolioAction()
    {
        $user      = \System\Auth\UserSession::getInstance()->getIdentity();
        $repo      = new Repository(Portfolio::class);
        $portfolio = new Portfolio();

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && true === empty($_POST)) {
            $portfolio = $repo->findAll([
              'user' => $user->getId()
            ]);
            $this->getView()->assign('portfolio', $portfolio);
            $this->getView()->view('user/portfolio');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
          true === isset($_POST['addLink']) &&
          false === isset($_POST['delButton'])
        ) {
            $this->getView()->view('user/add');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
          false === isset($_POST['addLink']) &&
          true === isset($_POST['delButton'])
        ) {
            array_shift($_POST);
            $elements = $_POST;
            foreach ($elements as $key => $value)
            {
                $portfolio = $repo->findOneBy([
                  'id' => (int) $value
                ]);
                $repo->delete($portfolio);
            }
            $portfolio = $repo->findAll([
              'user' => $user->getId()
            ]);
            $this->getView()->assign('portfolio', $portfolio);
            $this->getView()->view('user/portfolio');
        }

        if ($_POST['addButton'] === 'addButton') {
            $workName    = $_POST['workName'];
            $description = $_POST['description'];
            $imageName   = $_POST['imageName'];
            $site        = $_POST['site'];
            $portfolio->setWorkName($workName);
            $portfolio->setImageName($imageName);
            $portfolio->setDescription($description);
            $portfolio->setSite($site);
            $portfolio->setUser($user->getId());
            $repo->save($portfolio);
            $portfolio   = $repo->findAll([
              'user' => $user->getId()
            ]);
            $this->getView()->assign('portfolio', $portfolio);
            $this->redirect('user/portfolio');
        }
    }

    public function jobsstatusAction()
    {
        $user         = \System\Auth\UserSession::getInstance()->getIdentity();
        $projectsRepo = new Repository(Project::class);
        $projects     = new Project();
        if (true === empty($projectsRepo->findAll())) {
            $projects = $projectsRepo->findAll();
        }
        else {
            if ($user->getRole() === 'freelancer') {
                $repo       = new Repository(Freelancer::class);
                $freelancer = $repo->findOneBy([
                  'user' => $user->getId()
                ]);
                $projects   = $projectsRepo->findBy(['freelancer' => $freelancer->getId()]);
            }
            if ($user->getRole() === 'customer') {
                $repo     = new Repository(Customer::class);
                $customer = $repo->findOneBy([
                  'user' => $user->getId()
                ]);
                $projects = $projectsRepo->findBy(['customer' => $customer->getId()]);
            }
        }

        $name = array ();

        foreach ($projects as $project)
        {
            /** @var Project $project */
            if ($user->getRole() === 'freelancer') {
                $name[$project->getId()] = $project->getCustomer()->getUser()->getName();
            }
            else {

                // todo check if freelancer not null

                $name[$project->getId()] = $project->getFreelancer()
                  ->getUser()
                  ->getName();
            }
        }

        $this->getView()->assign('name', $name);
        $this->getView()->assign('projects', $projects);
        $this->getView()->view('user/jobsstatus');
    }

    public function newsAction()
    {
        $this->getView()->view('user/news');
    }

    public function logoutAction()
    {

    }

    public function testAction()
    {

    }

}
