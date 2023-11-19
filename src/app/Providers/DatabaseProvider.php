<?php

namespace App\Providers;


use App\Core\Database\Drivers\DatabaseDriverInterface;
use App\Core\Database\Drivers\MysqlDriver;

class DatabaseProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DatabaseDriverInterface::class, MysqlDriver::class);
    }
}
