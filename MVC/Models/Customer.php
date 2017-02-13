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
  private $user;

   /**
    * @var int
    * @column(project_balance)
   */
   private $projectBalance;

  /**
   * @return int id | null
   */
  public function getId(): int
  {
    return $this -> id;
  }

  /**
   * @return float
   */
  public function getRating()//: float
  {
    return $this -> rating;
  }

    /**
     * @return int|null
     */
    public function getProjectBalance()
    {
        return $this->projectBalance;
    }

  /**
   * @return Plan
   */
  public function getPlan(): Plan
  {
    $repo = new Repository( Plan::class );

    return $repo -> findOneBy(
        [
          'id' => $this -> plan
        ]
    );
  }

  /**
   * @return User|null
   */
  public function getUser(): User
  {
    $repo = new Repository( User::class );

    return $repo -> findOneBy( [
        'id' => $this -> user
      ] );
  }

  /**
   * @param int $plan
   */
  public function setPlan(int $plan)
  {
    $this -> plan = $plan;
  }

  /**
   * @param decimal $rating
   */
  public function setRating(float $rating)
  {
    $this -> rating = $rating;
  }

    /**
     * @param int $projectBalance
     */
    public function setProjectBalance(int $projectBalance)
    {
        $this->projectBalance = $projectBalance;
    }

}
