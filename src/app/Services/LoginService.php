<?php

namespace App\Services;

use App\Core\SessionManager;
use App\Dtos\LoginRequestDto;
use App\Models\UserModel;

class LoginService
{

    private UserModel $userModel;
    private SessionManager $session;

    public function __construct(UserModel $userModel,SessionManager $session)
    {
        $this->userModel = $userModel;
        $this->session = $session;
    }

    public function login(LoginRequestDto $loginRequestDto): bool
    {
        $user = $this->userModel->find(
            ['username' => $loginRequestDto->getUsername(), 'password' => $loginRequestDto->getPassword()]
        );

        if (!$user) {
            throw new \Exception('User not found');
        }

        $this->session->set('isLogin',true);

        return true;
    }
}
