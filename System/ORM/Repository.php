<?php

namespace System\ORM;

use System\Database\Connection;
use System\Pattern\Singleton;

/**
 * Class Repository
 * @package System\ORM
 *
 * @method static Repository getInstance()
 */
class Repository
{

    use Singleton;

    const COLUMN_PATTERN = '/\*[\s\t]+\@column\((\w+)\)/';

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var \ReflectionClass
     */
    protected $reflection;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    /**
     * @param $className
     * @return $this
     */
    public function model($className)
    {
        $this->className = $className;

        $this->reflection = new \ReflectionClass($this->className);

        foreach ($this->reflection->getProperties() as $property) {
            if (preg_match(static::COLUMN_PATTERN, $property->getDocComment(), $matches) === 1) {
                $this->properties[$property->getName()] = $matches[1];
            }
        }

        return $this;
    }

    /**
     * @return Model
     */
    public function createInstance()
    {
        return new $this->className;
    }

    /**
     * @param array $criteria
     * @param int $limit
     * @param int $offset
     * @param bool $order
     * @return array
     */
    public function findBy(array $criteria, $limit = 0, $offset = 0, $order = null)
    {
        $statement = $this->connection
            ->select()
            ->from($this->reflection->newInstance()->getStorageName())
            ->limit($limit)
            ->offset($offset);

        if ($order !== null) {
            $statement->orderBy($order);
        }

        foreach ($criteria as $key => $value) {
            if (isset($this->properties[$key]) === true) {
                $statement->_and()->where($this->properties[$key], '=', $value);
            }
        }

        $rows = $statement->execute();

        return array_map(function ($row) {

            $model = new $this->className;

            foreach ($this->properties as $property => $offset) {
                $reflectionProperty = $this->reflection->getProperty($property);
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($model, $row[$offset]);
                $reflectionProperty->setAccessible(false);
            }

            return $model;
        }, $rows);
    }

    /**
     * @param array $criteria
     * @param null $order
     * @return mixed|null
     */
    public function findOneBy(array $criteria, $order = null)
    {
        $models = $this->findBy($criteria, 1, 0, $order);

        return (isset($models[0]) === true && $models[0] instanceof Model === true) ? $models[0] : null;
    }

    /**
     * @param Model $model
     * @return bool|int
     */
    public function save(Model $model)
    {
        $statement = $this->connection
            ->insert()
            ->from($model->getStorageName())
            ->columns($this->properties);

        $values = [];

        foreach ($this->properties as $property => $offset) {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $values[] = $reflectionProperty->getValue($model);
            $reflectionProperty->setAccessible(false);
        }

        return $statement->values($values)->execute();
    }


}