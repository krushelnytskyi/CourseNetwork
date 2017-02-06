<?php

namespace MVC\Controllers;
use MVC\Models\Portfolio;
use MVC\Models\User;
use MVC\Models\Freelancer;
use MVC\Models\Project;
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
class Using extends Controller
{
    /**
     * Login action
     */
  public function mainAction () {
    $this->getView()->view('using/main');

  }
    public function settingAction ()
    {
      $user = \System\Auth\UserSession::getInstance()->getIdentity();

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $name = $_POST['name'] ? :null;
          $email = $_POST['login'] ? :null;
          $site = $_POST['site'] ? :null;
          $phone = $_POST['phone'] ? :null;
          $skype = $_POST['skype'] ? :null;
          $password = $_POST['password'] ? :null;
          $avatarName = $_POST['avatarName'] ? :null;
          $uploaddir = APP_ROOT.'assets/img/user-page/avatar/';
          $uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
          if (true === move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
              $this->getView()->view('using/setting');
          } else {
              $this->getView()
              ->assign('error', 'Upload avatar file');
          }
          $repo = new Repository(User::class);
          $subUser = new User();
          /** @var User $user */
          $subUser = $repo->findOneBy([
              'id'=> $user->getId()
          ]);
          if ($password !== null){
              $subUser->setPassword(User::hashPassword($password));
          }
          $subUser->setName($name);
          $subUser->setEmail($email);
          $subUser->setSite($site);
          $subUser->setPhone($phone);
          $subUser->setSkype($skype);
          $subUser->setAvatar($avatarName);
          $repo->update($subUser,$subUser->getId());
          $this->getView()->view('using/main');
      } else {
        $this->getView()->view('using/setting');
      }
     }
    /**
     * Register action
     */
    public function menuinfoAction()
    {
        $this->getView()->view('using/menuinfo');
    }
    public function portfolioAction()
    {
      $user = \System\Auth\UserSession::getInstance()->getIdentity();
      $repo = new Repository(Portfolio::class);
      $portfolio = new Portfolio();
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['addButton'] === 'addButton') {
          $this->getView()->view('using/add');

      } elseif (isset($_POST['workName'])){
          $workName = $_POST['workName'];
          $description = $_POST['description'];
          $imageName = $_POST['imageName'];
          $portfolio->setWorkName($workName);
          $portfolio->setImageName($imageName);
          $portfolio->setDescription($description);
          $portfolio->setUser($user->getId());
          $repo->save($portfolio);
          $this->getView()->view('using/portfolio');
        }

      else {
          $portfolio = $repo->findOneBy([
          'user'=> $user->getId()
          ]);
          $this->getView()->view('using/portfolio');
      }
    }
    public function workdiaryAction()
    {
      $this->getView()->view('using/workdiary');
    }
    public function jobsstatusAction()
    {
      $this->getView()->view('using/jobsstatus');
    }
    public  function  newsAction()
    {
      $this->getView()->view('using/news');
    }
    public function logoutAction()
    {

    }

    public function testAction()
    {

    }

}