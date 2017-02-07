<?php

namespace MVC\Models;

/**
 * Class Category
 * @package MVC\Models
 * @table(categories)
 */
class Category
{

    /**
     * @var int
     * @column(id)
     */
    private $id;

    /**
     * @var string
     * @column(name)
     */
    private $name;

    /**
     * @var string
     * @column(description)
     */
    private $description;

    /**
     * @var int
     * @column(count)
     */
    private $count;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getCount()
    {
        if(null !== $this->count) {
            return $this->count;
        }else{
            return 0;
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setCount(int $count)
    {
        $this->count = $count;
    }

}