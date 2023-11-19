<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Models\UserModel;
use App\Validation\LoginValidation;

class LoginController extends BaseController
{
    private Response $response;
    private UserModel $model;
    private Request $request;
    private LoginValidation $loginValidation;

    public function __construct(LoginValidation $loginValidation,Request $request, Response $response,UserModel $model)
    {
        $this->loginValidation = $loginValidation;
        $this->response = $response;
        $this->model = $model;
        $this->request = $request;
    }

    public function login()
    {
        return $this->response->render('Login');
    }
    public function loginPost()
    {
        $validator = $this->loginValidation->validate();
        if ($validator->requestHasError()){
            return $this->response->render('Login',compact('validator'));

        }
        dd(1);
        $user = $this->model->find(['username' => $this->request->getAttribute('username'), 'password' => 123]);
        if (!$user){
            throw new \Exception('User not found');
        }

        $this->cookie->set('isLogin',true);
    }
}
