<?php

namespace App\Controllers;

use App\Application;
use App\Core\Cookie\CookieManager;
use App\Core\Request;
use App\Core\ResponseInterface;
use App\Core\Router\Route;

class BaseController
{
    protected CookieManager $cookie;

    protected Request $request;

    protected ResponseInterface $response;
    protected Route $route;


    public function __construct()
    {
        $this->cookie = Application::$app->cookie;
        $this->response = Application::$app->response;
        $this->request = Application::$app->request;
        $this->route = Application::$app->route;
    }
}
