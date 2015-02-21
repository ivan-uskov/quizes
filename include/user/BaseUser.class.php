<?php

class BaseUser
{
    protected $id;
    protected $loginKey;
    protected $status;
    protected $email;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $phone;
    protected $country;
    protected $addDate;

    public function __construct($row = null)
    {
        $this->initFromRow($row);
    }

    public function initFromRow($row)
    {
        if (!is_null($row))
        {
            $this->id = $row['user_id'];
            $this->loginKey = $row['login_key'];
            $this->status = $row['status'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->firstName = $row['first_name'];
            $this->lastName = $row['last_name'];
            $this->phone = $row['phone'];
            $this->country = $row['country'];
            $this->addDate = $row['add_date'];
        }
    }

    public function getLoginKey()
    {
        return $this->loginKey;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getAddDate()
    {
        return $this->addDate;
    }

}