<?php

namespace App\Core;

class Response
{
    protected array $header;
    protected array $cookie;

    protected string $content;
    private string $templatePath;

    public function __construct()
    {
        $this->templatePath = APP_DIRECTORY . 'templates';
    }

    public function addCookie(
        $name,
        $value = null,
        $expire = null,
        $path = null,
        $domain = null,
        $secure = null,
        $httpOnly = null
    ) {
        $this->_cookies[$name] = [
            'value' => $value,
            'expire' => $expire,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'http' => $httpOnly,
        ];
    }

    public function deleteCookie($name)
    {
        unset($this->_cookies[$name]);
    }

    public function addHeader($name, $value)
    {
        $this->header[$name] = $value;
    }

    public function removeHeader($name)
    {
        unset($this->header[$name]);
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }


    public function render($template, array $data = [])
    {
        extract($data);
        ob_start();
        //TODO: Read the template path from config
        require $this->templatePath . '/' . strtolower($template) . '.php';
        return ob_get_clean();
    }


    public function getProtocolVersion(): string
    {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        // TODO: Implement withProtocolVersion() method.
    }

    public function getHeaders(): array
    {
        // TODO: Implement getHeaders() method.
    }

    public function hasHeader(string $name): bool
    {
        // TODO: Implement hasHeader() method.
    }

    public function getHeader(string $name): array
    {
        // TODO: Implement getHeader() method.
    }

    public function getHeaderLine(string $name): string
    {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader(string $name): MessageInterface
    {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody(): StreamInterface
    {
        // TODO: Implement getBody() method.
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        // TODO: Implement withBody() method.
    }

    public function getStatusCode(): int
    {
        // TODO: Implement getStatusCode() method.
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        // TODO: Implement withStatus() method.
    }

    public function getReasonPhrase(): string
    {
        // TODO: Implement getReasonPhrase() method.
    }

    public function showPage():void
    {
        echo $this->content;
    }

    public function setStatusCode(int $status)
    {
        http_response_code($status);
    }
}
