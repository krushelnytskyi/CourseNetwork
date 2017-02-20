<?php

namespace System\Database;

use System\Config;
use System\Database\Statement\Delete;
use System\Database\Statement\Insert;
use System\Database\Statement\Select;
use System\Database\Statement\Update;
use System\Pattern\Singleton;

/**
 * Class Connection
 * @package System\Database
 *
 * @method static Connection getInstance()
 */
class Connection
{

    use Singleton;

    /**
     * @var \mysqli
     */
    protected $link;

    /**
     * @var \mysqli
     */
    protected $connect;


    public function __construct()
    {
        $databaseConfig = Config::getInstance()->get('database');

        $this->link = new \mysqli(
            $databaseConfig['host'],
            $databaseConfig['username'],
            $databaseConfig['password']
        );

        $this->getLink()->select_db($databaseConfig['database']);
    }

    /**
     * @return \mysqli
     */
    public function getLink(): \mysqli
    {
        return $this->link;
    }

    /**
     * @return \mysqli
     */
    public function getConnect(): \mysqli
    {
        return $this->connect;
    }

    /**
     * Security for SQL injection
     * @param string $data
     * @return string
     */
    public function secureString($data)
    {
        $data = $this->link->escape_string($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = addslashes($data);

        return $data;
    }

    /**
     * @return Select
     */
    public function select()
    {
        return new Select();
    }

    /**
     * @return Insert
     */
    public function insert()
    {
        return new Insert();
    }

    public function delete()
    {
        return new Delete();
    }

    public function update()
    {
        return new Update();
    }

}