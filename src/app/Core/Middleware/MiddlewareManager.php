<?php

namespace App\Core\Middleware;

use App\Core\Request;

class MiddlewareManager
{
    /** @var MiddlewareInterface[] $middlewares */
    private array $middlewares = [];
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function run(): void
    {
        $pipeline = array_reduce($this->middlewares, function ($next, MiddlewareInterface $middleware) {
            return function ($request) use ($middleware, $next) {
                return $middleware->handle($request, $next);
            };
        }, fn() => null);

        $pipeline($this->request);
    }
}
