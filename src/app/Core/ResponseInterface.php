<?php

namespace App\Core;

interface ResponseInterface
{
    public function setContent(string $content): void;

    public function render($template, array $data = []): false|string;

    public function getStatusCode(): int;

    public function showPage(): void;

    public function setStatusCode(int $status): void;
}
