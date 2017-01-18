<?php

namespace System\Database;

/**
 * Class Statement
 * @package System\Database
 */
abstract class Statement
{
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
     * Build query, execute
     *
     * @return mixed
     */
    abstract public function execute();
}