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
     *
     */
    const STATUS_USER = 0;
    const STATUS_ADMIN = 1;

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
     * @column(status)
     */
    private $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
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