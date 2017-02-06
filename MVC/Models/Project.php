<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Project
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
   * @var int
   * @column(budget)
   */
  private $budget;

  /**
   * @var int
   * @column(requests_count)
   */
  private $requestsCount;

  /**
   * @var int
   * @column(bookmark_id)
   */
  private $bookmarkId;

  /**
   * @return int id | null
   */
  public function getId(): int
  {
    return $this -> id;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this -> name;
  }

  /**
   * @return string
   */
  function getCreated(): string
  {
    return $this -> created;
  }

  /**
   *
   * @return Category
   */
  function getCategory(): Category
  {
    $repo = new Repository( Category::class );

    return $repo -> findOneBy(
        [
          'id' => $this -> category
        ]
    );
  }

  /**
   * @return string
   */
  function getStart(): string
  {
    return $this -> start;
  }

  /**
   * @return string
   */
  function getFinish(): string
  {
    return $this -> finish;
  }

  /**
   * @return int
   */
  function getStatus(): int
  {
    return $this -> status;
  }

  /**
   * @return int
   */
  function getCost(): int
  {
    return $this -> cost;
  }

  /**
   * @return int
   */
  function getPaid(): int
  {
    return $this -> paid;
  }

  /**
   * @return Freelancer
   */
  function getFreelancer(): Freelancer
  {

    $repo = new Repository( Freelancer::class );

    return $repo -> findOneBy( [
        'category_id' => $this -> freelancer
      ] );
  }

  /**
   * @return Customer
   */
  function getCustomer(): Customer
  {

    $repo = new Repository( Customer::class );

    return $repo -> findOneBy( [
        'plan_id' => $this -> customer
      ] );
  }

  /**
   * @return string
   */
  function getDescription(): string
  {
    return $this -> description;
  }

  /**
   * @return string
   */
  function getWorkType(): string
  {
    return $this -> workType;
  }

  /**
   * @return int
   */
  function getBudget(): int
  {
    return $this -> budget;
  }

  /**
   * @return int
   */
  function getRequestsCount(): int
  {
    return $this -> requestsCount;
  }

  /**
   * @return int
   */
  function getBookmarkId(): int
  {
    return $this -> bookmarkId;
  }

  /**
   * @param int
   */
  public function setFreelancer( int $freelancer )
  {
    $this -> freelancer = $freelancer;
  }

  /**
   * @param int
   */
  public function setCustomer( int $customer )
  {
    $this -> customer = $customer;
  }

  /**
   * @param string $name
   */
  public function setName( string $name )
  {
    $this -> name = $name;
  }

  /**
   * @param string $start
   */
  public function setStart( string $start )
  {
    $this -> start = $start;
  }

  /**
   * @param string $finish
   */
  public function setFinish( string $finish )
  {
    $this -> finish = $finish;
  }

  /**
   * @param int $status
   */
  public function setStatus( int $status )
  {
    $this -> status = $status;
  }

  /**
   * @param int $cost
   */
  public function setCost( int $cost )
  {
    $this -> cost = $cost;
  }

  /**
   * @param int $paid
   */
  public function setPaid( int $paid )
  {
    $this -> paid = $paid;
  }

  /**
   *
   * @param string $created
   */
  function setCreated( string $created )
  {
    $this -> created = $created;
  }

  /**
   * @param int $category
   */
  function setCategory( int $category )
  {
    $this -> category = $category;
  }

  /**
   * @param string $description
   */
  function setDescription( string $description )
  {
    $this -> description = $description;
  }

  /**
   * @param string $workType
   */
  function setWorkType( string $workType )
  {
    $this -> workType = $workType;
  }

  /**
   * @param int $budget
   */
  function setBudget( int $budget )
  {
    $this -> budget = $budget;
  }

  /**
   * @param int $requestsCount
   */
  function setRequestsCount( int $requestsCount )
  {
    $this -> requestsCount = $requestsCount;
  }

  /**
   * @param int $bookmarkId
   */
  function setBookmarkId( int $bookmarkId )
  {
    $this -> bookmarkId = $bookmarkId;
  }

}
