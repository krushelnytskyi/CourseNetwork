<?php
namespace System\Database;
/**
 * Class Statement
 * @package System\Database
 */
abstract class Statement
{
    /**
     * Where patterns
     */
    const PATTERN_WHERE           = '%s `%s` %s \'%s\'';
    const PATTERN_WHERE_IN        = '`%s` IN (%s)';
    const PATTERN_WHERE_NOT_IN    = '`%s` NOT IN (%s)';
    const PATTERN_WHERE_LIKE      = '`%s` LIKE \'%s\'';
    const PATTERN_WHERE_NOT_LIKE  = '`%s` NOT LIKE \'%s\'';
    /**
     * Allowed conditions for where
     */
    const ALLOWED_CONDITIONS = [
        '=', '>', '<', '>=', '<=', '!='
    ];
    /**
     * @var string|null
     */
    protected $table;
    /**
     * @var int
     */
    protected $limit = 0;
    /**
     * @var int
     */
    protected $offset = 0;
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var string
     */
    protected $where;
    /**
     * @var string
     */
    protected $whereCondition;
    /**
     * Statement constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }
    /**
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->table = $table;
        return $this;
    }
    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    /**
     * @param array $columns
     * @return string
     */
    protected function encodeColumns(array $columns)
    {
        return '`' . implode('`, `', $columns) . '`';
    }
    /**
     * @param array $values
     * @return string
     */
    protected function encodeValues(array $values)
    {
        $values = array_map(function($value) {
            return $this->connection->getLink()->real_escape_string($value);
        }, $values);
        return '\'' . implode('\', \'', $values) . '\'';
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
            static::PATTERN_WHERE, //sprintf format
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
        if (is_array($values) === true) {
            $values = '\'' . implode('\', \'', array_map(
                    function ($value) {
                        return $this->connection->getLink()->real_escape_string($value);
                    },
                    $values
                )) . '\'';
        } else {
            $values = $this->connection->getLink()->real_escape_string($values);
        }
        $this->where .= sprintf($pattern, $field, $values);
        return $this;
    }

    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function whereLike($field, $values)
    {
        return $this->buildWhere($field, $values, static::PATTERN_WHERE_LIKE);
    }
    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function whereNotLike($field, $values)
    {
        return $this->buildWhere($field, $values, static::PATTERN_WHERE_NOT_LIKE);
    }

    /**
     * @return $this
     */
    public function _or()
    {
        $this->whereCondition = ($this->where !== null) ? ' OR ' : '';
        return $this;
    }
    /**
     * @return $this
     */
    public function _and()
    {
        $this->whereCondition = ($this->where !== null) ? ' AND ' : '';
        return $this;
    }
    /**
     * Build query, execute
     *
     * @return mixed
     */
    abstract public function execute();
}
