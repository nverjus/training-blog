<?php
namespace Blog\Entity;

use NV\MiniFram\Entity;

class User extends Entity
{
    protected $username;
    protected $password;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }
}
