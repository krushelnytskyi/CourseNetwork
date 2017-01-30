<?php

namespace MVC\Controllers;

use MVC\Models\User;
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
class Users extends Controller
{
    /**
     * Login action
     */
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $repo = new Repository(User::class);

            /** @var User $user */
            $user = $repo->findOneBy(
                [
                    'email'    => $email,
                    'password' => User::hashPassword($password)
                ]
            );

            if ($user === null) {
                $this->getView()
                    ->assign('error', 'Invalid email or/and password');
            } else {
                UserSession::getInstance()
                    ->setIdentity($user->getId());

                $this->forward('home/index');
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

            $repo = new Repository(User::class);

            /** @var User $user */
            $user = $repo->findOneBy(
                [
                    'email'    => $email,
                ]
            );

            if ($user === null) {
                $user = new User();

                if ($repo->findBy() == NULL){
                    $user->setStatus(User::STATUS_SUPER_ADMIN);
                }

                $user->setEmail($email);
                $user->setName($name);
                $user->setPassword(User::hashPassword($password));

                $repo->save($user);

                $this->forward('users/login');

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

    public function testAction()
    {
        var_dump(
            UserSession::getInstance()->
                getIdentity()
        );
    }



}