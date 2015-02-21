<?php

class UserStatus
{
    const TEACHER = 0;
    const STUDENT = 1;

    public static function toString($status)
    {
        switch ($status)
        {
            case self::STUDENT:
                return "Student";
            case self::TEACHER:
                return "Teacher";
            default:
                throw new Exception("Invalid status!");
        }
    }
}