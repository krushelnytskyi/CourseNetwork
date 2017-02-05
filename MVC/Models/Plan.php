<?php

namespace MVC\Models;

/**
 * Class Plan
 * @package MVC\Models
 * @table(plans)
 */
class Plan
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
   * @column(description)
   */
  private $description;

  /**
   * @var int
   * @column(request_amount)
   */
  private $requestAmount;

  /**
   * @var int
   * @column(skills_amount)
   */
  private $skillsAmount;

  /**
   * @var int
   * @column(follow_allow)
   */
  private $followAllow;

  /**
   * @var int
   * @column(article_allow)
   */
  private $articleAllow;

  /**
   * @var int
   * @column(project_amount)
   */
  private $projectAmount;

  /**
   * @var boolean
   * @column(for_freelancer)
   */
  private $forFreelancer;

  /**
   * @var boolean
   * @column(for_customer)
   */
  private $forCustomer;

  /**
   * @return int
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
  public function getDescription(): string
  {
    return $this -> description;
  }

  /**
   * @return int
   */
  public function getRequestAmount(): int
  {
    return $this -> requestAmount;
  }

  /**
   * @return int
   */
  public function getSkillsAmount(): int
  {
    return $this -> skillsAmount;
  }

  /**
   * @return int
   */
  public function getFollowAllow(): int
  {
    return $this -> followAllow;
  }

  /**
   * @return int
   */
  public function getArticleAllow(): int
  {
    return $this -> articleAllow;
  }

  /**
   * @return int
   */
  public function getProjectAmount(): int
  {
    return $this -> projectAmount;
  }

  /**
   * @return bool
   */
  public function getForFreelancer(): bool
  {
    return $this -> forFreelancer;
  }

  /**
   * @return bool
   */
  public function getForCustomer(): bool
  {
    return $this -> forCustomer;
  }

  /**
   * @param string $name
   */
  public function setName( string $name )
  {
    $this -> name = $name;
  }

  /**
   * @param string $description
   */
  public function setDescription( string $description )
  {
    $this -> description = $description;
  }

  /**
   * @param int $requestAmount
   */
  public function setRequestAmount( int $requestAmount )
  {
    $this -> requestAmount = $requestAmount;
  }

  /**
   * @param int $skillsAmount
   */
  public function setSkillsAmount( int $skillsAmount )
  {
    $this -> skillsAmount = $skillsAmount;
  }

  /**
   * @param int $followAllow
   */
  public function setFollowAllow( int $followAllow )
  {
    $this -> followAllow = $followAllow;
  }

  /**
   * @param int $articleAllow
   */
  public function setArticleAllow( int $articleAllow )
  {
    $this -> articleAllow = $articleAllow;
  }

  /**
   * @param int $projectAmount
   */
  public function setProjectAmount( int $projectAmount )
  {
    $this -> projectAmount = $projectAmount;
  }

  /**
   * @param bool $forFreelancer
   */
  public function setForFreelancer( bool $forFreelancer )
  {
    $this -> forFreelancer = $forFreelancer;
  }

  /**
   * @param bool $forCustomer
   */
  public function setForCustomer( bool $forCustomer )
  {
    $this -> forCustomer = $forCustomer;
  }

}
