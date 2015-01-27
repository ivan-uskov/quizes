<?php

class User extends BaseUser
{
    public function getName()
    {
        $name = '';
        if (!empty($this->firstName))
        {
            $name .= $this->firstName;
        }
        if (!empty($this->lastName))
        {
            $name .= !empty($name) ? ' ' . $this->lastName : $this->lastName;
        }
        return !empty($name) ? $name : $this->email;
    }
}