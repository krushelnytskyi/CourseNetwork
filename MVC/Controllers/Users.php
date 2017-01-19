<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\Session;
use System\Controller;
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
                $this->getView()->assign('error', 'Invalid email or/and password');
            } else {
                Session::getInstance()->setIdentity($user->getId());
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

        $this->getView()->view('users/register');
    }

    /**
     * Action for controller testing
     */
    public function testAction()
    {
        $this->getView()->view('test');
    }

}