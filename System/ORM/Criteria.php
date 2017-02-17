<?php
namespace System\ORM;
use System\Database\Statement\Select;
/**
 * Class Criteria
 * @package System\ORM
 */
class Criteria extends Select
{
    /**
     * @var array
     */
    protected $repository;
    /**
     * Criteria constructor.
     * @param Repository $repository
     */
    public function __construct($repository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->from($repository->getStorage());
    }
    /**
     * @param $field
     * @param $values
     * @param $pattern
     * @return $this
     */
    public function buildWhere($field, $values, $pattern)
    {
        $field = $this->repository->getProperty($field);
        return parent::buildWhere($field, $values, $pattern);
    }
    /**
     * @param int $limit
     * @param int $offset
     * @param null $order
     * @return array
     */
    public function getResult($limit = 0, $offset = 0, $order = null)
    {
        return $this->repository->findBy($this, $limit, $offset, $order);
    }
}