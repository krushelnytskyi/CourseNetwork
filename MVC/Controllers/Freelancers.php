<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;

/**
 * Class Freelancers
 * @package MVC\Controllers
 */
class Freelancers extends Controller
{
  /**
   * Search Projects Action
   */
  public function searchAction()
  {
    $this->getView()->view('freelancers/search');
  }
}
