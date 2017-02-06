<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Transaction
 * @package MVC\Models
 * @table(transactions)
 */
class Transaction
{

  /**
   * @var int
   * @column(id)
   */
  private $id;

  /**
   * @var float
   * @column(amount)
   */
  private $amount;

  /**
   * @var string
   * @column(date)
   */
  private $date;

  /**
   * @var float
   * @column(count_after_of)
   */
  private $countAfterOf;

  /**
   * @var int
   * @column(project_id)
   */
  private $projectId;

  /**
   * @var int
   * @column(sender)
   */
  private $sender;

  /**
   * @var int
   * @column(receiver)
   */
  private $receiver;

  /**
   * @return int
   */
  function getId(): int
  {
    return $this -> id;
  }

  /**
   * @return float
   */
  function getAmount(): float
  {
    return $this -> amount;
  }

  /**
   * @return string
   */
  function getDate(): string
  {
    return $this -> date;
  }

  /**
   * @return float
   */
  function getCountAfterOf(): float
  {
    return $this -> countAfterOf;
  }

  /**
   * @return \MVC\Models\Project
   */
  function getProjectId(): Project
  {
    $repo = new Repository( Project::class );

    return $repo -> findOneBy( [
        'id' => $this -> projectId
      ] );
  }

  /**
   * @return int
   */
  function getSender(): int
  {
    return $this -> sender;
  }

  /**
   * @return int
   */
  function getReceiver(): int
  {
    return $this -> receiver;
  }

  /**
   * @param float $amount
   */
  function setAmount( float $amount )
  {
    $this -> amount = $amount;
  }

  /**
   * @param string $date
   */
  function setDate( string $date )
  {
    $this -> date = $date;
  }

  /**
   * @param float $countAfterOf
   */
  function setCountAfterOf( float $countAfterOf )
  {
    $this -> countAfterOf = $countAfterOf;
  }

  /**
   * @param int $projectId
   */
  function setProjectId( int $projectId )
  {
    $this -> projectId = $projectId;
  }

  /**
   * @param int $sender
   */
  function setSender( int $sender )
  {
    $this -> sender = $sender;
  }

  /**
   * @param int $receiver
   */
  function setReceiver( int $receiver )
  {
    $this -> receiver = $receiver;
  }

}
