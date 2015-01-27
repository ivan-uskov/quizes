<?php

class Secure
{
    public static function pwdEncode($pwd)
    {
        return md5($pwd);
    }
}