<?php

namespace System\ORM;

use System\Database\Connection;

/**
 * Class Repository
 * @package System\ORM
 */
class Repository
{

    /**
     * @var \ReflectionClass
     */
    protected $reflection;

    /**
     * @var string
     */
    protected $storage;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Repository constructor.
     * @param string $modelName Example: MVC\Models\User
     */
    public function __construct($modelName)
    {
        $this->reflection = new \ReflectionClass($modelName);
        $properties = $this->reflection->getProperties();

        foreach ($properties as $property) {
            $docBlock = $property->getDocComment();

            if (preg_match('/@column\((.+)\)/', $docBlock, $matches) === 1) {
                $this->properties[$property->getName()] = $matches[1];
            }
        }

        if (preg_match('/@table\((.+)\)/', $this->reflection->getDocComment(), $matches)) {
            $this->storage = $matches[1];
        }
    }

    /**
     * @param array $criteria
     * @param $limit
     * @param $offset
     * @param $order
     * @return array
     */
    public function findBy(array $criteria, $limit = null, $offset = null, $order = null)
    {
        $statement = Connection::getInstance()
            ->select()
            ->from($this->storage);

        if ($limit !== null) {
            $statement->limit($limit);
        }

        foreach ($criteria as $field => $value) {
            $statement
                ->_and()
                ->where($this->properties[$field], '=', $value);
        }

        $rows = $statement->execute();
        $models = [];

        foreach ($rows as $row) {

            $model = $this->reflection->newInstance();

            foreach ($this->properties as $property => $key) {
                $reflectionProperty =
                    $this->reflection->getProperty($property);
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($model, $row[$key]);
                $reflectionProperty->setAccessible(false);
            }

            $models[] = $model;
        }

        return $models;
    }

    /**
     * @param array $criteria
     * @return object|null
     */
    public function findOneBy(array $criteria = [])
    {
        $models = $this->findBy($criteria, 1);

        if (isset($models[0]) === true) {
            return $models[0];
        }

        return null;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->findBy([]);
    }

    /**
     * @param $model
     * @return bool|int
     */
    public function save($model)
    {
        $statement = Connection::getInstance()->insert();

        $columns = [];
        $values = [];

        foreach ($this->properties as $property => $column) {
            $reflectionProperty = $this->reflection->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $value = $reflectionProperty->getValue($model);

            if ($value !== null) {
                $columns[] = $this->properties[$reflectionProperty->getName()];
                $values[] = $value;
            }

            $reflectionProperty->setAccessible(false);
        }
         return $statement
            ->from($this->storage)
            ->columns($columns)
            ->values($values)
            ->execute();
    }

<<<<<<< HEAD (c040001) - ...

=======
    /**
     * @param object $model
     */
    public function delete($model, $id)
    {

            $statement = Connection::getInstance()
	
            ->delete()
            ->from($this->storage);
			
			$statement->where($this->properties['id'], '=', $id);
			$result = $statement->execute();	
			
			return $result === false ? 0 : 'видалило '.$id;
		
}

>>>>>>> origin/master (4d87f81) - redirect with 
}
