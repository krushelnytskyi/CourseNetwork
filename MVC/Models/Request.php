<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Request
 * @package MVC\Models
 * @table(requests)
 */
class Request
{

  /**
   * @var int
   * @column(id)
   */
  private $id;

  /**
   * @var int
   * @column(project_id)
   */
  private $projectId;

  /**
   * @var int
   * @column(freelancer_id)
   */
  private $freelancerId;

  /**
   * @var string
   * @column(request_text)
   */
  private $requestText;

  /**
   * @var float
   * @column(rate)
   */
  private $rate;

  /**
   * @return int
   */
  function getId(): int
  {
    return $this -> id;
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
   * @return \MVC\Models\Freelancer
   */
  function getFreelancerId(): Freelancer
  {
    $repo = new Repository( Freelancer::class );

    return $repo -> findOneBy( [
        'id' => $this -> freelancerId
      ] );
  }

  /**
   * @return string
   */
  function getRequestText(): string
  {
    return $this -> requestText;
  }

  /**
   * @return float
   */
  function getRate(): float
  {
    return $this -> rate;
  }

  /**
   * @param int $projectId
   */
  function setProjectId( int $projectId )
  {
    $this -> projectId = $projectId;
  }

  /**
   * @param int $freelancerId
   */
  function setFreelancerId( int $freelancerId )
  {
    $this -> freelancerId = $freelancerId;
  }

  /**
   * @param string $requestText
   */
  function setRequestText( string $requestText )
  {
    $this -> requestText = $requestText;
  }

  /**
   * @param float $rate
   */
  function setRate( float $rate )
  {
    $this -> rate = $rate;
  }

}
