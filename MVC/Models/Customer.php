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
  public function setPlan( int $plan )
  {
    $this -> plan = $plan;
  }

  /**
   * @param int $user_id
   */
  public function setUser( /*int*/ $user_id )
  {
    $this -> user = $user_id;
  }

  /**
   * @param decimal $rating
   */
  public function setRating( float $rating )
  {
    $this -> rating = $rating;
  }

}
