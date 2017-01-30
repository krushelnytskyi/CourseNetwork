<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;

/**
 * Class Projects
 * @package MVC\Controllers
 */
class Projects extends Controller
{
  /**
   * Search Projects Action
   */
  public function searchAction() {
    $this->getView()->view('projects/search');
  }

  /**
   * Create Project Action
   */
  public function createAction() {
    $this->getView()->view('projects/create');
  }
}
