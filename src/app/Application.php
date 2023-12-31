<?php

namespace App;

use App\Core\Config\Config;
use App\Core\Middleware\MiddlewareManager;
use App\Core\Request;
use App\Core\Response;
use App\Core\ResponseInterface;
use App\Core\Router\Route;
use App\Core\SessionManager;

class Application extends Container
{
    public static Application $app;
    public MiddlewareManager $middlewareManager;
    public Route $route;

    public Request $request;

    public ResponseInterface $response;
    public SessionManager $session;

    public function __construct()
    {
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->route = new Route($this->response);
        $this->middlewareManager = new MiddlewareManager($this->request);
        $this->session = new SessionManager();
    }


    public function run(): void
    {
        $this->loadApplication();
        $this->loadProviders();

        $this->handleRequest();
    }

    public function handleRequest(): void
    {
        $matchRoute = $this->route->findPath(
            $this->request->getMethod(),
            $this->request->getAttribute('action', '/')
        );

        $this->loadMiddlewares();
        $this->middlewareManager->run();

        $this->route->render(
            $this->resolveDependecy($matchRoute['controller'])
        );
    }

    private function loadProviders(): void
    {
        $providers = Config::get('app','providers');
        foreach ($providers as $provider){
            $this->resolveDependecy($provider)->register();
        }
    }

    private function loadApplication(): void
    {
        $this->bind(Application::class, $this);
    }

    private function loadMiddlewares(): void
    {
        $middlewares = Config::get('app','middlewares');
        foreach ($middlewares as $middlewareName =>  $middleware){
            if(in_array($middlewareName,$this->route->getMiddlewares())){
                $this->middlewareManager->add(
                    $this->resolveDependecy($middleware)
                );
            }
        }
    }
}
