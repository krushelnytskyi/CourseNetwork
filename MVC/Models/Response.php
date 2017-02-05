<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Response
 * @package MVC\Models
 * @table(responses)
 */
class Response
{

  /**
   * @var int
   * @column(id)
   */
  private $id;

  /**
   * @var string
   * @column(body)
   */
  private $body;

  /**
   * @var int
   * @column(mark)
   */
  private $mark;

  /**
   * @var int
   * @column(sender_id)
   */
  private $senderId;

  /**
   * @var int
   * @column(receiver_id)
   */
  private $receiverId;

  /**
   * @return int
   */
  function getId(): int
  {
    return $this -> id;
  }

  /**
   * @return string
   */
  function getBody(): string
  {
    return $this -> body;
  }

  /**
   * @return int
   */
  function getMark(): int
  {
    return $this -> mark;
  }

  /**
   * @return \MVC\Models\Freelancer
   */
  function getSenderId(): Freelancer
  {

    $repo = new Repository( Freelancer::class );

    return $repo -> findOneBy( [
        'id' => $this -> senderId
      ] );
  }

  /**
   * @return \MVC\Models\Customer
   */
  function getReceiverId(): Customer
  {

    $repo = new Repository( Customer::class );

    return $repo -> findOneBy( [
        'id' => $this -> receiverId
      ] );
  }

  /**
   * @param string $body
   */
  function setBody( string $body )
  {
    $this -> body = $body;
  }

  /**
   * @param int $mark
   */
  function setMark( int $mark )
  {
    $this -> mark = $mark;
  }

  /**
   * @param int $senderId
   */
  function setSenderId( int $senderId )
  {
    $this -> senderId = $senderId;
  }

  /**
   * @param int $receiverId
   */
  function setReceiverId( int $receiverId )
  {
    $this -> receiverId = $receiverId;
  }

}
