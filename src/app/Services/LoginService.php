<?php

namespace App\Services;

use App\Core\Cookie\CookieManager;
use App\Dtos\LoginRequestDto;
use App\Models\UserModel;

class LoginService
{

    private UserModel $userModel;
    private CookieManager $cookieManager;

    public function __construct(UserModel $userModel,CookieManager $cookieManager)
    {
        $this->userModel = $userModel;
        $this->cookieManager = $cookieManager;
    }

    public function login(LoginRequestDto $loginRequestDto): bool
    {
        $user = $this->userModel->find(
            ['username' => $loginRequestDto->getUsername(), 'password' => $loginRequestDto->getPassword()]
        );

        if (!$user) {
            throw new \Exception('User not found');
        }

        $this->cookieManager->set('isLogin',true);

        return true;
    }
}
