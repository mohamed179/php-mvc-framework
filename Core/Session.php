<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function isSet(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unset(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
}