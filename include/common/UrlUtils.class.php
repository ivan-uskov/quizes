<?php

class UrlUtils
{
    const SIGN_IN_URL = 'sign-in.php';

    public static function redirect($url)
    {
        header("Location: " . $url);
        die();
    }

    public static function forwardSingIn()
    {
        self::redirect(self::SIGN_IN_URL);
    }
}