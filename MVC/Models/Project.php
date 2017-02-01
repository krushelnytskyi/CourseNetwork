<?php

namespace MVC\Models;
use System\ORM\Repository;

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
     * @var timestamp
     * @column(start)
     */
    private $start;

    /**
     * @var timestamp
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
        $repo = new Repository(Project::class);
        $this->id = (int) $repo->findOneBy([
            'freelancer'=>$this->freelancer,
            'customer' => $this->customer,
            'name' => $this->name
        ])->id;
        return $this->id;
    }
    /**
    * @return string name | null
    */
    public function getName($id)  // id project
    {
        $repo = new Repository(Project::class);
        $this->name = $repo->findOneBy([
        'id'=>$id
        ])->name;
        return $this->name;
  }
    /**
     * @param int $freelancer
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
    }
    /**
    * @param int $customer
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
    * @param timestamp $start
    */
    public function setStart($start)
    {
        $this->start = $start;
    }
    /**
    * @param timestamp $finish
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