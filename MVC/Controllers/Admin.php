<?php

namespace MVC\Controllers;

use MVC\Models\Category;
use MVC\Models\Customer;
use MVC\Models\Freelancer;
use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;
use System\ORM\Repository;

/**
 * Class Admin
 * @package MVC\Controllers
 */
class Admin extends Controller
{

    /**
     * @inheritdoc
     */
    public function initial()
    {
        $hasIdentity = UserSession::getInstance()->hasIdentity();

//        if (false === $hasIdentity || UserSession::getInstance()->getIdentity()->getRole() !== User::STATUS_USER) {
//            $this->getView()->view('404');
//            exit(0);
//        }
    }


    /**
     * Main admin-page Action
     */
    public function mainAction()
    {
        $this->getView()->view('admin/main');
    }

    /**
     * List of users Action
     */
    public function usersAction()
    {
        $usersRepo = new Repository(User::class);
        $customersRepo = new Repository(Customer::class);
        $freelancersRepo = new Repository(Freelancer::class);

        $usersList = $usersRepo->findAll();
        $customersList = $customersRepo->findAll();
        $freelancersList = $freelancersRepo->findAll();

        $this->getView()->assign('usersList', $usersList);
        $this->getView()->assign('customersList', $customersList);
        $this->getView()->assign('freelancersList', $freelancersList);

        $this->getView()->view('admin/users');
    }

    /**
     * List of freelancers Action
     */
    public function freelancersAction()
    {
        $dbConnect = Connection::getInstance();

        if ($dbConnect->getLink() === false) {
            $this->getView()->assign('error', 'Boss, we have problems with database connection');
        }

        $freelancersList = $dbConnect->select()
            ->from('freelancers')
            ->execute();

        $this->getView()->assign('list', $freelancersList);

        $this->getView()->view('admin/freelancers');
    }

    /**
     * List of customers Action
     */
    public function customersAction()
    {
        $dbConnect = Connection::getInstance();

        if ($dbConnect->getLink() === false) {
            $this->getView()->assign('error', 'Boss, we have problems with database connection');
        }

        $customersList = $dbConnect->select()
            ->from('customers')
            ->execute();

        $this->getView()->assign('list', $customersList);

        $this->getView()->view('admin/customers');
    }

    /**
     *
     */
    public function categoriesAction()
    {
        $repo = new Repository(Category::class);
        $categories = $repo->findAll();

        $this->getView()->assign('categories', $categories);
        $this->getView()->view('admin/categories');
    }

    public function createCategoryAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $repo = new Repository(Category::class);
            $category = new Category();
            $category->setName($name);
            $category->setDescription($description);

            $repo->save($category);
            $this->redirect('admin/categories');
        }
    }

}