<?php

namespace System\Database\Statement;

use System\Database\Statement;

/**
 * Class Delete
 * @package System\Database\Statement
 */
class Delete extends Statement
{

    /**
     * @var string
     */
    public $orderByLimit = '';


    /**
     * @param $orderBy
     * @param $limit
     * @return $this
     */
    public function orderByLimit ($orderBy, $limit)
    {
        if (($orderBy != '')&&($limit != 0)&&($orderBy != null)&&($limit != null)) {
            $this->orderByLimit = ' ORDER BY ' . $orderBy . ' LIMIT ' . $limit;

        } else {
            $this->orderByLimit = null;
        }

        return $this;
    }

    /**
     * DELETE FROM table_name
     * DELETE FROM table_name WHERE id = 2 AND email = 'email@com'
     * DELETE
     * @return int
     */
    public function execute()
    {
        if (false == $this->connection->getLink()) {
            return null;
        }

        $sql = 'DELETE  FROM ' . $this->table;

        if (null !== $this->where) {
            $sql .= ' WHERE ' . $this->where;
        }

        if (null !== $this->orderByLimit) {
            $sql .= $this->orderByLimit;
        }

        $result = $this->connection->getLink()->query($sql);

        return $result === false ? 0 : $this->connection->getLink()->affected_rows;
    }

}