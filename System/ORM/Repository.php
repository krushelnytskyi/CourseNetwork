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
    public function findBy(array $criteria = [], $limit = null, $offset = null, $order = null)
    {
        $statement = Connection::getInstance()
            ->select()
            ->from($this->storage);

        if ($limit !== null) {
            $statement->limit($limit);
        }

        foreach ($criteria as $field => $value) {
            $statement->where($this->properties[$field], '=', $value);
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
     * @param object $model
     */
    public function save(object $model)
	//public function save()
    {
        // TODO Insert from object
	
		}

    /**
     * @param array $criteria
     */
    public function delete(array $criteria, $orderByLimit = null)
    {
		
	$statement = Connection::getInstance()
	
            ->delete()
            ->from($this->storage);
			
        foreach ($criteria as $field => $value) {
            $statement->where($this->properties[$field], '=', $value);
        }
		
		if (null !== $this->orderByLimit) {
            $statement .= $this->orderByLimit;
        }
		
		$del = $statement->execute();	
		
}

public function deleteV2(array $criteria, $orderByLimit = null)
    {
		
	$statement = Connection::getInstance()
	
            ->delete()
            ->from($this->storage);
			
			foreach ($criteria as $key => $field) {
				
        foreach ($criteria[$key] as $field => $value) {
			
			if ($key == 'WHERE') {
            $statement->where($this->properties[$field], '=', $value);
			}
			
			if ($key == 'OR') {
            $statement->_or();
			$statement->where($this->properties[$field], '=', $value);
			}
			
			if ($key == 'AND') {
            $statement->_and();
			$statement->where($this->properties[$field], '=', $value);
			}
			
        }
			}
		
		if (null !== $this->orderByLimit) {
            $statement .= $this->orderByLimit;
        }
		
		$del = $statement->execute();	
		
}

}
