<?php

namespace App\Core\Middleware;

use Closure;
interface MiddlewareInterface
{
    public function handle($request, Closure $next);
}
