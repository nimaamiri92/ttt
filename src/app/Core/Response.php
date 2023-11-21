<?php

namespace App\Core;

class Response implements ResponseInterface
{
    protected string $content;
    private string $templatePath;

    public function __construct()
    {
        $this->templatePath = APP_DIRECTORY . 'templates';
    }


    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function render($template, array $data = []): false|string
    {
        extract($data);
        ob_start();
        //TODO: Read the template path from config
        require $this->templatePath . '/' . strtolower($template) . '.php';
        return ob_get_clean();
    }

    public function getStatusCode(): int
    {
        return http_response_code();
    }

    public function showPage(): void
    {
        echo $this->content;
    }

    public function setStatusCode(int $status): void
    {
        http_response_code($status);
    }
}
