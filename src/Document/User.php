<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $login;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $password;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $role;

    /**
     * Get Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Title
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set title
     * @param $value
     */
    public function setLogin($value)
    {
        $this->login = $value;
    }

    /**
     * Get password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     * @param $value
     */
    public function setPassword($value)
    {
        $this->password = md5($value);
    }

    /**
     * Get role
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     * @param $value
     */
    public function setRole($value)
    {
        $this->role = $value;
    }

}