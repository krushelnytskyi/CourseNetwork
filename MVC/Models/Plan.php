<?php

namespace MVC\Models;

/**
 * Class Plan
 * @package MVC\Models
 * @table(plans)
 */
class Plan
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
     * @column(request_amount)
     */
    private $requestAmount;

    /**
     * @var int
     * @column(project_amount)
     */
    private $projectAmount;

    /**
     * @var float
     * @column(price)
     */
    private $price;

    /**
     * @var string
     * @column(role)
     */
    private $role;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getProjectAmount()
    {
        return $this->projectAmount;
    }

    /**
     * @return int|null
     */
    public function getRequestAmount()
    {
        return $this->requestAmount;
    }

    /**
     * @return string
     */
    public function getRole():string
    {
        return $this->role;
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

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @param int $projectAmount
     */
    public function setProjectAmount(int $projectAmount)
    {
        $this->projectAmount = $projectAmount;
    }

    /**
     * @param int $requestAmount
     */
    public function setRequestAmount(int $requestAmount)
    {
        $this->requestAmount = $requestAmount;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

}
