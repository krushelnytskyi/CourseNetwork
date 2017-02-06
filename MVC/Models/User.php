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
    * @var float
    * @column(balance)
    */
    private $balance;
    /**
    * @var string
    * @column(site)
    */
    private $site;
    /**
    * @var string
    * @column(phone)
    */
    private $phone;

    /**
    * @var string
    * @column(skype)
    */
    private $skype;
    /**
    * @var string
    * @column(avatar)
    */
    private $avatar;

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
    * @return float
    */
    public function getBalance()
    {
        return $this->balance;
    }
    /**
    * @return string
    */
    public function getSite()
    {
        return $this->site;
    }
    /**
    * @return string
    */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
    * @return string
    */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
    * @return string
    */
    public function getAvatar()
    {
        return $this->avatar;
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
    * @param float $balance
    */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
    * @param string $site
    */
    public function setSite($site)
    {
        $this->site = $site;
    }
    /**
    * @param string $phone
    */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    /**
    * @param string $skype
    */
    public function setSkype($skype)
    {
        $this->skype = $skype;
    }
    /**
    * @param string $avatar
    */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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