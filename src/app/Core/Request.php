<?php

namespace App\Core;

class Request
{
    protected array $server;
    protected array $getRequest;
    protected array $postRequest;

    public function __construct()
    {
        $this->server = $_SERVER;
        $this->getRequest = $_GET;
        $this->postRequest = $_POST;
    }

    public function getMethod(): string
    {
        return strtoupper($this->server['REQUEST_METHOD']);
    }

    public function getParsedBody(): array
    {
        return $_POST;
    }

    public function getAttributes(): array
    {
        return $_GET;
    }

    public function getAttribute(string $name, $default = null)
    {
        if (isset($_GET[$name])){
            return $_GET[$name];
        }

        if (isset($_POST[$name])){
            return $_POST[$name];
        }

        return $default;
    }
}
