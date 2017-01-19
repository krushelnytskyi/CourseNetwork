<?php

namespace MVC\Models;

use System\ORM\Model;

/**
 * Class User
 * @package MVC\Models
 */
class User extends Model
{

    const STORAGE_NAME = 'users';

    /**
     * @column(id)
     * @var int
     */
    private $id;

    /**
     * @column(name)
     * @var string
     */
    private $name;

    /**
     * @column(email)
     * @var string
     */
    private $email;

    /**
     * @column(password)
     * @var string
     */
    private $password;

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
     *
     */
    public static function passwordHash($plain)
    {
        return password_hash(
            $plain,
            PASSWORD_BCRYPT,
            [
                'salt' => md5($plain),
                'cost' => 12
            ]
        );
    }

}