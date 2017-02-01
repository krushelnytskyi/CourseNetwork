<?php

namespace MVC\Models;
use System\ORM\Repository;

/**
 * Class Customer
 * @package MVC\Models
 * @table(customers)
 */
class Customer
{
    /**
     * @var int
     * @column(id)
     */
    private $id;

    /**
     * @var float
     * @column(rating)
     */
    private $rating;

    /**
     * @var int
     * @column(plan_id)
     */
    private $plan;

    /**
     * @var int
     * @column(user_id)
     */
    private $user_id;

    /**
     * @return int id | null
     */
    public function getId()
    {
        $repo = new Repository(Customer::class);
        $this->id = (int) $repo->findOneBy([
        'user_id'=>$this->user_id
        ])->id;
        return $this->id;
    }

    /**
     * @return float
     */
    public function getRating()
    {
      $repo = new Repository(Customer::class);
      $this->rating = (float) $repo->findOneBy([
        'user_id'=>$this->user_id
      ])->rating;
        return $this->rating;
    }

    /**
     * @return Plan|null
     */
    public function getPlan()
    {
        $repo = new Repository('\MVC\Models\Plan');

        return $repo->findOneBy(
            [
                'id' => $this->plan
            ]
        );
    }
    /**
     * @return User|null
     */
    public function getUser()
    {
        $repo = new Repository(User::class);
        return $repo->findOneBy([
            'id' => $this->user_id
        ]);
    }



    /**
     * @param int $plan
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;
    }

    /**
     * @param int $user_id
     */
    public function setUser($user_id)
    {
        $this->user_id = $user_id;
    }

  /**
   * @param decimal $rating
   */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}