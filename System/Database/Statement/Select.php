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
     * Allowed conditions for where
     */
    const ALLOWED_CONDITIONS = [
        '=', '>', '<', '>=', '<=', '!='
    ];

    /**
     * Where patterns
     */
    const PATTERN_WHERE        = '%s `%s` %s \'%s\'';
    const PATTERN_WHERE_IN     = '`%s` IN (%s)';
    const PATTERN_WHERE_NOT_IN = '`%s` NOT IN (%s)';

    /**
     * @var array|string
     */
    protected $columns = '*';

    /**
     * @var string
     */
    protected $where;

    /**
     * @var string
     */
    protected $orderBy;

    /**
     * @var string
     */
    protected $whereCondition;

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
     * @param $field
     * @param $delimiter
     * @param $value
     * @return $this
     */
    public function where($field, $delimiter, $value)
    {
        if (false == in_array($delimiter, static::ALLOWED_CONDITIONS)) {
            return $this;
        }

        $where = sprintf(
            static::PATTERN_WHERE,
            $this->whereCondition,
            $field,
            $delimiter,
            $this->connection->getLink()->real_escape_string($value)
        );

        if (null !== $this->whereCondition) {
            $this->where .= $where;
            $this->whereCondition = null;
        } else {
            $this->where = $where;
        }

        return $this;
    }

    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function whereIn($field, $values)
    {
        return $this->buildWhere($field, $values, static::PATTERN_WHERE_IN);
    }

    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function whereNotIn($field, $values)
    {
        return $this->buildWhere($field, $values, static::PATTERN_WHERE_NOT_IN);
    }

    /**
     * @param $field
     * @param $values
     * @param $pattern
     * @return $this
     */
    protected function buildWhere($field, $values, $pattern)
    {
        if (null !== $this->whereCondition) {
            $this->where .= ' ' . $this->whereCondition . ' ';
            $this->whereCondition = null;
        } else {
            $this->where = null;
        }

        $this->where .= sprintf(
            $pattern,
            $field,
            '\'' . implode('\', \'', array_map(
                function ($value) {
                    return $this->connection->getLink()->real_escape_string($value);
                },
                $values
            )) . '\''
        );

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
     * @return $this
     */
    public function _or()
    {
        $this->whereCondition = 'OR';
        return $this;
    }

    /**
     * @return $this
     */
    public function _and()
    {
        $this->whereCondition = 'AND';
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