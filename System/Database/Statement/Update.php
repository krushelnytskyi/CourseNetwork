<?php

namespace System\Database\Statement;

use System\Database\Statement;

/**
 * Class Update
 * @package System\Database\Statement
 */
class Update extends Statement
{
    /**
     * @var array
     */
    protected $set = [];

    /**
     * @var array
     */
    protected $where;

    /**
     * @param string|array $set
     * @return $this
     */
    public function set(array $set)
    {

        foreach ( $set as $key => $value )
        {
            $this->set[] = '`' . $key . '`' . ' = ' . '\'' . $value . '\'';
        }

        return $this;
    }

    /**
     * @return int|bool Last inserted ID
     */
    public function execute()
    {
        $sql = 'UPDATE `' . $this->table . '` SET ' . implode( ', ', $this ->set );
        $sql .= ($this->where !== null) ? ' WHERE ' . $this->where : '';
        $sql .= ($this->limit !== 0) ? ' LIMIT ' . $this->limit : '';

        $result = $this->connection->getLink()->query( $sql );

        return ( false === $result ) ? false : $this->connection->getLink()->affected_rows;

    }

}