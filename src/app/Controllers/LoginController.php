<?php

namespace App\Controllers;

use App\Dtos\LoginRequestDto;
use App\Models\UserModel;
use App\Services\LoginService;
use App\Validation\LoginValidation;

class LoginController extends BaseController
{
    private LoginValidation $loginValidation;
    private LoginService $loginService;

    public function __construct(LoginValidation $loginValidation, LoginService $loginService)
    {
        parent::__construct();

        $this->loginValidation = $loginValidation;
        $this->loginService = $loginService;
    }

    public function login()
    {
        return $this->response->render('Login');
    }

    public function loginPost()
    {
        $validator = $this->loginValidation->validate();
        if ($validator->requestHasError()) {
            return $this->response->render('Login', compact('validator'));
        }

        $this->loginService->login(
            LoginRequestDto::fromRequest($validator->validated())
        );

        $this->route->redirect('/home');
    }
}
