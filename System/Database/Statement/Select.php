<?php

namespace System\Database\Statement;

use System\Database\Statement;

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
            $this->columns = implode(',', $columns);
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
     * @return objeect $this
     */
    public function andWhere($field, $delimiter, $value)
    {
        if ('' === $this->where) {
            return $this;
        }

        $this->where($field, $delimiter, $value, ' AND');
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

        $this->where($field, $delimiter, $value, ' OR');
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
     * @param int $start
     * @param int $finish
     * @return object $this
     */
    public function limit($start = 0, $finish = 0)
    {
        if ((int)($start) == 0 && (int)($finish) == 0) {
            return $this;
        }

        $this->limit = $start . ',' . $finish;
        return $this;
    }

    /**
     * @param int $offset
     * @return object $this
     */
    public function offset($offset = 0)
    {
        if ((int)($offset) == 0) {
            return $this;
        }

        $this->offset = $offset;
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
                ' FROM ' . $this->table .
                ' WHERE ' . $this->where .
                ' ORDER BY ' . $this->orderBy .
                ' OFFSEt ' . $this->offset . ';';

        return $this->connection->getLink()->query($sql);
    }

}