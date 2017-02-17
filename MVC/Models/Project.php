<?php

namespace MVC\Models;

use System\ORM\Repository;


/**
 * Class Projects
 * @package MVC\Models
 * @table(projects)
 */
class Project
{

    const TYPE_PER_HOUR = 'per-hour';
    const TYPE_FIXED = 'fixed-price';
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
     * @var string
     * @column(work_type)
     */
    private $workType;

    /**
     * @var float
     * @column(budget)
     */
    private $budget;

    /**
     * @var int
     * @column(requests_count)
     */
    private $requestsCount;

    /**
     * @var string
     * @column(created)
     */
    private $created;

    /**
     * @var int
     * @column(category)
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
     * @return string
     */
    public function getWorkType(): string
    {
        return $this->workType;
    }

    /**
     * @return int
     */
    public function getRequestsCount(): int
    {
        return $this->requestsCount;
    }

    /**
     * @return float
     */
    public function getBudget(): float
    {
        return $this->budget;
    }

    /**
     * @return object|null
     */
    public function getCategory()
    {
        $repo = new Repository(Category::class);
        $category = $repo->findOneBy(['id'=>$this->category]);

        return $category;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return strtotime($this->created);
    }

    /**
     * @return Customer|null
     */
    public function getCustomer()
    {
        $repo = new Repository(Customer::class);
        $customer = $repo->findOneBy(['id'=>$this->customer]);

        return $customer;
    }

    /**
     * @return Freelancer|null
     */
    public function getFreelancer()
    {
        if(null !== $this->freelancer) {
            $repo = new Repository(Freelancer::class);
            $freelancer = $repo->findOneBy(['id' => $this->freelancer]);

            return $freelancer;
        }else{
            return 0;
        }
    }

    /**
     * @return string
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * @return int
     */
    public function getPaid(): int
    {
        return $this->paid;
    }

    /**
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
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
     * @param int $category
     */
    public function setCategory(int $category)
    {
        $this->category = $category;
    }

    /**
     * @param int $requestsCount
     */
    public function setRequestsCount(int $requestsCount)
    {
        $this->requestsCount = $requestsCount;
    }

    /**
     * @param string $workType
     */
    public function setWorkType(string $workType)
    {
        $this->workType = $workType;
    }

    /**
     * @param int $freelancer
     */
    public function setFreelancer(int $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * @param int $customer
     */
    public function setCustomer(int $customer)
    {
        $this->customer = $customer;
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
     * @param int $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @param int $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

}