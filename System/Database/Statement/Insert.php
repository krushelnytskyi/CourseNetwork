<?php

namespace System\Database\Statement;

use System\Database\Statement;

/**
 * Class Insert
 * @package System\Database\Statement
 */
class Insert extends Statement
{

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $values;

    /**
     * @param $columns
     * @return $this
     */
    public function columns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function values(array $values)
    {
        if (array_values($values) === $values) {
            $this->values = $values;
        } else {
            $this->columns = array_keys($values);
            $this->values = array_values($values);
        }

        return $this;
    }

    /**
     * @return int|bool Last inserted ID
     */
    public function execute()
    {
        $sql = 'INSERT INTO ' . $this->table;

        if (null !== $this->columns) {
            $sql .= ' (' . $this->encodeColumns($this->columns) . ') ';
        }

        $sql .= ' VALUES ' . '(' . $this->encodeValues($this->values) . ')';

        $result = $this->connection->getLink()->query($sql);

        return (false === $result) ? false : $this->connection->getLink()->insert_id;
    }

}