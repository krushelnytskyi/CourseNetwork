<?php

namespace System\Database\Statement;

use System\Database\Statement;

/**
 * Class Select
 * @package System\Database\Statement
 */
class Select extends Statement
{

    const ALLOWED_CONDITIONS = [
        '=', '>', '<', '>=', '<=', '!='
    ];

    const PATTERN_WHERE        = '%s `%s` %s \'%s\'';
    const PATTERN_WHERE_IN     = '%s `%s` IN (%s)';
    const PATTERN_WHERE_NOT_IN = '%s `%s` NOT IN (%s)';

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
     * @param string|array $columns
     * @return object $this
     */
    public function columns($columns = '*')
    {
        if (true == is_array($columns)) {
            $this->columns = '`' . implode('`, `', $columns) . '`';
        }
        
        return $this;
    }

    /**
     * @param $field
     * @param $delimiter
     * @param $value
     * @param string $additionalCondition
     * @return $this
     */
    public function where($field, $delimiter, $value, $additionalCondition = '')
    {
        if (false == in_array($delimiter, static::ALLOWED_CONDITIONS)) {
            return $this;
        }

        $this->where .= sprintf(
            static::PATTERN_WHERE,
            $additionalCondition,
            $field,
            $delimiter,
            $this->connection->getLink()->real_escape_string($value)
        );

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
     * @param $field
     * @param $values
     * @param string $additionalCondition
     * @return $this
     */
    public function whereIn($field, $values, $additionalCondition = '')
    {
        $this->where .= sprintf(
            static::PATTERN_WHERE_IN,
            $additionalCondition,
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