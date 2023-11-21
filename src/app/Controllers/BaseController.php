<?php

namespace App\Controllers;

use App\Application;
use App\Core\Request;
use App\Core\ResponseInterface;
use App\Core\Router\Route;
use App\Core\SessionManager;

class BaseController
{
    protected SessionManager $session;

    protected Request $request;

    protected ResponseInterface $response;

    protected Route $route;


    public function __construct()
    {
        $this->session = Application::$app->session;
        $this->response = Application::$app->response;
        $this->request = Application::$app->request;
        $this->route = Application::$app->route;
    }
}
