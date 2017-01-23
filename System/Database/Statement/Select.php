<?php

namespace System\Database\Statement;

use System\Database\Statement;

/**
 * Class Select
 * @package System\Database\Statement
 */
class Select extends Statement
{

    /**
     * @var array|string
     */
    protected $columns = '*';

    /**
     * @var string
     */
    protected $orderBy;

    /**
     * @param string|array $columns
     * @return object $this
     */
    public function columns($columns = '*')
    {
        if (true == is_array($columns)) {
            $this->columns = $this->encodeColumns($columns);
        }

        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function count($field = '*')
    {
        $this->columns = 'COUNT(' . $field . ') AS count';
        return $this;
    }

    /**
     * @param string $field
     * @param string $sort
     * @return $this
     */
    public function orderBy($field, $sort = 'ASC')
    {
        $this->orderBy = $field . ' ' . $sort;
        return $this;
    }

    /**
     * @return array
     */
    public function execute()
    {
        if (false == $this->connection->getLink()) {
            return null;
        }

        $sql = 'SELECT ' . $this->columns .
                ' FROM ' . $this->table;

        if (null !== $this->where) {
            $sql .= ' WHERE ' . $this->where;
        }

        if (null !== $this->orderBy) {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }

        if (0 < $this->limit) {

            $sql .= ' LIMIT ';

            if (0 < $this->offset) {
                $sql .= (int)$this->offset . ', ';
            }

            $sql .= (int)$this->limit;
        }

        $result = $this->connection->getLink()->query($sql);
        $resultArray = [];

        if (true === $result instanceof \mysqli_result) {
            while (null !== ($row = $result->fetch_assoc())) {
                $resultArray[] = $row;
            }
        }

        return $resultArray;
    }

}