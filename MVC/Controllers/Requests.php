<?php

namespace MVC\Controllers;

use MVC\Models\Category;
use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;
use System\ORM\Repository;

/**
 * Class Requests
 * @package MVC\Controllers
 */
class Requests extends Controller
{
   /* public function requestAction()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $projectId = $_POST['projectId'];
            $freelancerId = $_POST['freelancerId'];

            $requestRepository = new Repository(Request::class);
            $request = new Request();

            $request->setProjectId($projectId);
            $request->setFreelancerId($freelancerId);
            $requestRepository->save($request);

            $this->getView()->assign('thisrequest', $requestRepository->findBy($request->getId()));
            $this->getView()->view('projects/requests');

        }
    }*/
}
