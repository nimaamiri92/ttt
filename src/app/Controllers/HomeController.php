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
        $pa['email'] = 'nima@nima.com';
        $data = $this->databaseManager->connection()
            ->from('writer')
            ->where('email','nima@nima.com')
            ->where('firstname','Nima')
            ->exec();
dd($data);
//        $this->databaseManager->connection()->save('writer',[
//            'firstname' => 'ali',
//            'lastname' => 'ali',
//            'email'=> 'ali@ali.com',
//            'password' => md5(123123)
//        ])->exec();
//        dd(1);
        return $this->response->render('Home',[]);
    }
}
