<?php

namespace System;
use System\Auth\UserSession;
use MVC\Models\User;
abstract class Controller
{

    public function initial()
    {
        $hasIdentity = UserSession::getInstance()->hasIdentity();
        if(false === $hasIdentity ){
          $this->getView()->view('404');
        }  else {
              $status = UserSession::getInstance()->getIdentity()->getStatus();
              if ($status === (string) User::STATUS_ADMIN) {
                  $this->getView()->view('admin/users');
              };
              if ($status === (string) User::STATUS_USER) {
                  $this->getView()->view('home/index');
              };
        }


    }

    /**
     * @return View
     */
    public function getView()
    {
        return View::getInstance();
    }

    public function forward($url)
    {
        Dispatcher::getInstance()->dispatch($url);
        exit(0);
    }

}