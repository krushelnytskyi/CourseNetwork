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
    protected $where = '';

    /**
     * @var string
     */
    protected $orderBy = '';

    /**
     * @var array
     */
    private $delimiters = ['=', '>', '<', '>=', '<=', '!='];

    /**
     * @param string|array $columns
     * @return object $this
     */
    public function columns($columns = '*')
    {
        if (true == is_array($columns)) {
            $this->columns = '\'' . implode('\', \'', $columns) . '\'';
        }

        return $this;
    }

    /**
     * @param string $field
     * @param string $delimiter
     * @param string $value
     * @return object $this
     */
    public function where($field, $delimiter, $value, $additionalCondition = '')
    {
        if (false == in_array($delimiter, $this->delimiters)) {
            return $this;
        }

        $this->where .= $additionalCondition . $field . $delimiter . $value;
        return $this;
    }

    /**
     * @param string $field
     * @param string $delimiter
     * @param string $value
     * @return object $this
     */
    public function andWhere($field, $delimiter, $value)
    {
        if ('' === $this->where) {
            return $this;
        }

        return $this->where($field, $delimiter, $value, ' AND');
    }

    /**
     * @param string $field
     * @param string $delimiter
     * @param string $value
     * @return object $this
     */
    public function orWhere($field, $delimiter, $value)
    {
        if ('' === $this->where) {
            return $this;
        }

        return $this->where($field, $delimiter, $value, ' OR');
    }

    /**
     * @param string $field
     * @param string $sort
     * @return object $this
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

        if ('' !== $this->where) {
            $sql .= ' WHERE ' . $this->where;
        }

        if ('' !== $this->orderBy) {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }

        if (0 !== $this->limit) {
            $sql .= ' LIMIT ' . $this->offset . ',' . $this->limit;
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