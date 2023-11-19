<?php

namespace App\Controllers;

use App\Core\Database\DatabaseManager;
use Psr\Http\Message\ResponseInterface;

class HomeController extends BaseController
{
    private ResponseInterface $response;
    private DatabaseManager $databaseManager;

    public function __construct(ResponseInterface $response,DatabaseManager $databaseManager)
    {
        $this->response = $response;
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
