<?php

namespace MVC\Controllers;

//use MVC\Models\User;
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
  public function mainAction () {
    $this->getView()->view('user/main');
  }
    public function settingAction ()
    {
      $this->getView()->view('user/setting');
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
      $this->getView()->view('user/portfolio');
    }
    public function workdiaryAction()
    {
      $this->getView()->view('user/workdiary');
    }
    public function jobsstatusAction()
    {
      $this->getView()->view('user/jobsstatus');
    }
    public  function  messagesAction()
    {

    }
    public function logoutAction()
    {

    }

    public function testAction()
    {

    }

}