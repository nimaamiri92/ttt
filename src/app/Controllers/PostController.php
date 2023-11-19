<?php

namespace App\Controllers;

use App\Application;

class PostController extends BaseController
{
    public function index()
    {
        return Application::$app->response->render('post');

    }
}
