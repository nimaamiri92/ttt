<?php

namespace App\Controllers;

use App\Core\Database\DatabaseManager;
use App\Core\ResponseInterface;

class HomeController extends BaseController
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();
        $this->databaseManager = $databaseManager;
    }
    public function index()
    {
        return $this->response->render('Home');
    }
}
