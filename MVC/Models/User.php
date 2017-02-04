<?php

namespace MVC\Models;

/**
 * Class User
 * @package MVC\Models
 * @table(users)
 */
class User
{

    /**
     * User roles
     */
    const ROLE_ADMIN       = 'admin';
    const ROLE_FREELANCER  = 'freelancer';
    const ROLE_CUSTOMER    = 'customer';
    const ROLE_SUPER_ADMIN = 'super_admin';

    /**
     * @var int
     * @column(id)
     */
    private $id;

    /**
     * @var string
     * @column(name)
     */
    private $name;

    /**
     * @var string
     * @column(email)
     */
    private $email;

    /**
     * @var string
     * @column(password)
     */
    private $password;

    /**
     * @var int
     * @column(role)
     */
    private $role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $name
     */
    public function setName($name) //string
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlan()
    {
        // @todo return Plan Model class
    }

    /**
     * @param int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @param $password
     * @return bool|string
     */
    public static function hashPassword ($password)
    {
        $options = [
            'salt' => md5($password),
            //write your own code to generate a suitable salt
            'cost' => 12
            // the default cost is 10
        ];

        $hash = password_hash($password, PASSWORD_DEFAULT, $options);

        return $hash;
    }

}