<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\Session;
use System\ORM\Repository;
use System\View;

/**
 * Class Users
 * @package MVC\Controllers
 */
class Users extends Abstraction\Front
{
    /**
     * Login action
     */
    public function loginAction()
    {
        $view = new View();

        if (true === isset($_POST['email']) && true === isset($_POST['password'])) {

            /** @var User $user */
            $user = Repository::getInstance()
                ->model(User::class)
                ->findOneBy(
                    [
                        'email'    => $_POST['email'],
                        'password' => User::passwordHash($_POST['password'])
                    ]
                );

            if (null === $user) {
                $view->assign('error', 'Invalid email or/and password');
            } else {
                Session::getInstance()->setIdentity($user->getId());
                $this->forward('home/index');
            }
        }

        return $view->view('users/login');
    }

    /**
     * Register action
     */
    public function registerAction()
    {
        if (isset($_POST['email']) === true && isset($_POST['password']) === true) {
            $email = $_POST['email'];
            $password = User::passwordHash($_POST['password']);

            $user = Repository::getInstance()
                ->model(User::class)
                ->findOneBy(['email' => $email]);

            if (null === $user) {

                $user = new User();
                $user->setEmail($email);
                $user->setName($email);
                $user->setPassword($password);

                Repository::getInstance()->save($user);
                $this->forward('users/login');
            }
        }

        return new View('users/register');
    }

}