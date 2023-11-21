<?php

namespace App\Dtos;

class LoginRequestDto
{
    private string $username;
    private string $password;

    private function __construct(string $username,string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    public static function fromRequest(array $payload)
    {
        return new static($payload['username'],$payload['password']);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

}
