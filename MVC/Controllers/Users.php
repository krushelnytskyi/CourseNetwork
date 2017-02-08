<?php

namespace MVC\Controllers;

use MVC\Models\Category;
use MVC\Models\Customer;
use MVC\Models\Freelancer;
use MVC\Models\Project;
use MVC\Models\User;
use MVC\Models\Plan;
use System\Auth\Session;
use System\Auth\UserSession;
use System\Config;
use System\Controller;
use System\Database\Connection;
use System\Form\Login;
use System\ORM\Repository;

/**
 * Class Users
 * @package MVC\Controllers
 */
class Users extends Controller
{
    /**
     * Login action
     */
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $form = new Login($_POST);

            $email = $_POST['email'];
            $password = $_POST['password'];

            $repo = new Repository(User::class);

            /** @var User $user */
            $user = $repo->findOneBy(
                [
                    'email' => $email,
                    'password' => User::hashPassword($password)
                ]
            );

            if ($user === null) {
                $this->getView()
                    ->assign('error', 'Invalid email or/and password');
            } else {
                UserSession::getInstance()
                    ->setIdentity($user->getId());

                $this->forward('using/main');
            }
        }

        $this->getView()->view('users/login');
    }

    /**
     * Register action
     */
    public function registerAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $repo = new Repository(User::class);

            /** @var User $user */
            $user = $repo->findOneBy(
                [
                    'email' => $email,
                ]
            );

            if ($user === null) {
                $user = new User();

                if ($repo->findAll() == null) {
                    $user->setRole(User::ROLE_SUPER_ADMIN);
                }

                $user->setEmail($email);
                $user->setName($name);
                $user->setPassword(User::hashPassword($password));

                $user->setRole($role);
                $userId = $repo->save($user);

                if ($role === User::ROLE_CUSTOMER
                    || $role === User::ROLE_FREELANCER
                ) {

                    if ($role === User::ROLE_CUSTOMER) {

                        $planRepository = new Repository(Plan::class);
                        $plan = new Plan();
                        $plan->setName(Plan::PLAN_ORDINARY);

                        $plan->setType('customer');
                        $planId = $planRepository->save($plan);

                        $subRepository = new Repository(Customer::class);
                        $subUser = new Customer();

                        $subUser->setPlan($planId);
                        $subUser->setRating('0');

                        $subUser->setUser($userId);
                        $subRepository->save($subUser);


                    } else {

                        $planRepository = new Repository(Plan::class);
                        $plan = new Plan();
                        $plan->setName(Plan::PLAN_ORDINARY);

                        $plan->setType('freelancer');
                        $planId = $planRepository->save($plan);

                        $subRepository = new Repository(Freelancer::class);
                        $subUser = new Freelancer();
                        $subUser->setRate('0');

                        $subUser->setPlan($planId);
                        $subUser->setCategoryId('0');

                        $subUser->setUser($userId);
                        $subRepository->save($subUser);


                    }


                    $this->forward('users/login');
                } else {
                    $this->getView()
                        ->assign('error', 'Select your website role');
                }

            } else {
                $this->getView()
                    ->assign('error', 'Account already exists');
            }
        }

        $this->getView()->view('users/register');
    }

    public function logoutAction()
    {
        UserSession::getInstance()->clearIdentity();
        $this->forward('users/login');
    }

}
