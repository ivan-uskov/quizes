<?php

class Session
{
    const USER_LOGIN_KEY = 'user_login_key';
    const SESSION_ID = 'Account';

    public static function get($name, $default = null)
    {
        return isset($_SESSION[$name]) && !empty($_SESSION[$name]) ? $_SESSION[$name] : $default;
    }

    public static function getUserData()
    {
        return self::get(self::USER_LOGIN_KEY);
    }

    public static function setUser($loginKey)
    {
        $_SESSION[self::USER_LOGIN_KEY] = $loginKey;
    }
}