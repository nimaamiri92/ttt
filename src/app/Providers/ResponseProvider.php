<?php

namespace App\Providers;

use App\Core\Response;
use Psr\Http\Message\ResponseInterface;

class ResponseProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ResponseInterface::class, Response::class);
    }
}
