<?php

namespace App\Controllers;

use App\Application;
use App\Core\Cookie\CookieManager;

class BaseController
{
    protected CookieManager $cookie;
    public function __construct()
    {
        $this->cookie= Application::$app->cookie;
    }
}
