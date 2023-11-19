<?php

namespace App\Core\Router;


use App\Controllers\BaseController;
use App\Core\Response;

class Route
{

    private array $routeList = [];

    private array $currentRoute = [];
    private array $currentMiddleware = [];
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function addRoute(string $method, string $path, array $target, $middleware = []): void
    {
        $this->routeList[strtoupper($method)][$path] = [
            'controller' => $target[0],
            'method' => $target[1],
            'middleware' => $middleware,
        ];
    }

    public function findPath($method, $name): ?array
    {
        $matchedRoute = $this->routeList[strtoupper($method)][$name] ?? null;
        if (!$matchedRoute) {
            $this->response->setStatusCode(404);
            die('Route not found');
        }

        if (!class_exists($matchedRoute['controller'])) {
            die(sprintf("%s Controller not found!", $matchedRoute['controller']));
        }

        if (!method_exists($matchedRoute['controller'], $matchedRoute['method'])) {
            die(sprintf("There is no %s method in this controller %s", $matchedRoute['method'], $matchedRoute['controller']));
        }

        $this->setCurrentMiddleware($matchedRoute['middleware']);
        $this->setCurrentRoute($matchedRoute);

        return $matchedRoute;
    }

    public function getALl()
    {
        return $this->routeList;
    }

    public function redirect($redirect): void
    {
        header("Location: ?action=$redirect");
        exit();
    }

    public function render(BaseController $resolvedControllerDependencies): void
    {
        $payload = call_user_func([$resolvedControllerDependencies,$this->currentRoute['method']]);
        $this->response->setContent($payload);
        $this->response->showPage();
    }

    /**
     * @return array
     */
    public function getCurrentMiddleware(): array
    {
        return $this->currentMiddleware;
    }

    /**
     * @param array $currentMiddleware
     */
    public function setCurrentMiddleware(array $currentMiddleware): void
    {
        $this->currentMiddleware = $currentMiddleware;
    }

    /**
     * @return array
     */
    public function getCurrentRoute(): array
    {
        return $this->currentRoute;
    }

    /**
     * @param array $currentRoute
     */
    public function setCurrentRoute(array $currentRoute): void
    {
        $this->currentRoute = $currentRoute;
    }

}
