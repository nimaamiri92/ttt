<?php

namespace App\Providers;

use App\Application;

abstract class ServiceProvider
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    abstract public function register(): void;
}
