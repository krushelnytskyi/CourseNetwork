<?php

namespace MVC\Models;

/**
 * Class User
 * @package MVC\Models
 * @table(portfolio)
 */
class Portfolio {
  /**
   * @var int
   * @column(id)
   */
  private $id;

  /**
   * @var string
   * @column(work_name)
   */
  private $workName;

  /**
   * @var string
   * @column(description)
   */
  private $description;

  /**
   * @var string
   * @column(image_name)
   */
  private $imageName;

  /**
   * @var int
   * @column(user_id)
   */
  private $user;

    public function getId() {
      return $this->id;
    }

    /**
     * @return string
     */
    public function getWorkName() {
      return $this->workName;
    }

    /**
     * @return string
     */
    public function getDescription() {
      return $this->description;
    }

    /**
     * @return string
     */
    public function getImageName() {
      return $this->imageName;
    }


    /**
     * @param int $user
     */
    public function setUser($user) {
      $this->user = $user;
    }

    /**
     * @param string $workName
     */
    public function setWorkName($workName) {
      $this->workName = $workName;
    }

    /**
     * @param string $descripton
     */
    public function setDescription($description) {
      $this->description = $description;
    }
    /**
     * @param string $imageName
     */
    public function setImageName($imageName) {
      $this->imageName = $imageName;
    }
}
