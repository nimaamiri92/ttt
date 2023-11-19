<?php

namespace App\Middleware;

use App\Application;
use App\Core\Middleware\MiddlewareInterface;
use Closure;

class AuthenticateMiddleware implements MiddlewareInterface
{
    public function handle($request, Closure $next)
    {
//        if (!Application::$app->cookie->get('isLogin')) {
//            Application::$app->route->redirect('/login');
//        }

        // Call the next middleware or the final endpoint
        return $next($request);
    }
}
