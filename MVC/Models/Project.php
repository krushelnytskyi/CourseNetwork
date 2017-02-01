<?php

namespace MVC\Models;

/**
 * Class Customer
 * @package MVC\Models
 * @table(projects)
 */
class Project
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
     * @column(created)
     */
    private $created;

    /**
     * @var int
     * @column(category_id)
     */
    private $category;

    /**
     * @var string
     * @column(start)
     */
    private $start;

    /**
     * @var string
     * @column(finish)
     */
    private $finish;

    /**
     * @var int
     * @column(status)
     */
    private $status;
    /**
     * @var int
     * @column(cost)
     */
    private $cost;
    /**
     * @var int
     * @column(paid)
     */
    private $paid;
    /**
     * @var int
     * @column(freelancer)
     */
    private $freelancer;
    /**
     * @var int
     * @column(customer)
     */
    private $customer;

    /**
     * @return int id | null
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * @param int
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param string $finish
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param int $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @param int $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

}