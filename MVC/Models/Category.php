<?php

namespace MVC\Models;

/**
 * Class Category
 * @package MVC\Models
 * @table(categories)
 */
class Category
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
   * @column(count)
   */
  private $count;

  /**
   * @var string
   * @column(slug)
   */
  private $slug;

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
  function getCount(): int
  {
    return (int)$this->count;
  }

  /**
   * @return string
   */
  function getSlug(): string
  {
    return $this -> slug;
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
   * @param int $count
   */
  function setCount( int $count )
  {
    $this -> count = $count;
  }

  /**
   * @param string $slug
   */
  function setSlug( string $slug )
  {
    $this -> slug = $slug;
  }

}
