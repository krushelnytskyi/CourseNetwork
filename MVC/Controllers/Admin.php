<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;

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

        if (false === $hasIdentity || UserSession::getInstance()->getIdentity()->getStatus() === User::STATUS_USER) {
            $this->getView()->view('404');
            exit(0);
        }
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
        $dbConnect = Connection::getInstance();

        if ($dbConnect->getLink() === false) {
            $this->getView()->assign('error', 'Boss, we have problems with database connection');
        }

        $usersList = $dbConnect->select()
            ->from('users')
            ->execute();

        /* Uncomment for $usersList reverse sort */
        //$usersList = array_reverse($usersList);

        $this->getView()->assign('list', $usersList);

        $this->getView()->view('admin/users');
    }

}