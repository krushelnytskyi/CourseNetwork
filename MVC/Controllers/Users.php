<?php

namespace MVC\Controllers;

use MVC\Models\Customer;
use MVC\Models\Freelancer;
use MVC\Models\Project;
use MVC\Models\User;
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
                    'email'    => $email,
                    'password' => $password
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
                    'email'    => $email,
                ]
            );

            if ($user === null) {
                $user = new User();

                if ($repo->findAll() == null){
                    $user->setRole(User::ROLE_SUPER_ADMIN);
                }

                $user->setEmail($email);
                $user->setName($name);
                $user->setPassword(User::hashPassword($password));

                if ($role === User::ROLE_CUSTOMER
                    || $role === User::ROLE_FREELANCER
                ) {
                    if ($role === User::ROLE_CUSTOMER) {
                        $subRepository = new Repository(Customer::class);
                        $subUser = new Customer();
                        $subUser->setUser($user->getId());
                    } else {
                        $subRepository = new Repository(Freelancer::class);
                        $subUser = new Freelancer();

                    }

                    $user->setRole($role);

                    $userId = $repo->save($user);

                    $subUser->setUser($userId);
                    $subRepository->save($subUser);

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
