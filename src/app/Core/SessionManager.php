<?php

namespace App\Core;


class SessionManager
{
    private string|false $sessionId;
    private $sessionData;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        };
        $this->sessionId = session_id();
        $this->sessionData = &$_SESSION;
    }

    public function set($key, $value)
    {
        $this->sessionData[$key] = $value;
    }

    public function get($key)
    {
        if (isset($this->sessionData[$key])) {
            return $this->sessionData[$key];
        } else {
            return null;
        }
    }

    public function all()
    {
        return $this->sessionData;
    }

    public function remove($key)
    {
        unset($this->sessionData[$key]);
    }

    public function clear()
    {
        session_unset();
        $this->sessionData = [];
    }

    public function destroy()
    {
        session_destroy();
        $this->sessionId = null;
        $this->sessionData = [];
    }

    public function isValid()
    {
        return isset($this->sessionId) && !empty($this->sessionId);
    }


    public function getSessionId()
    {
        return $this->sessionId;
    }
}
