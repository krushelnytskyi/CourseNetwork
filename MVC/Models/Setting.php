<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Category
 * @package MVC\Models
 * @table(settings)
 */
class Setting
{

  /**
   * @var int
   * @column(id)
   */
  private $id;

  /**
   * @var int
   * @column(user_id)
   */
  private $userId;

  /**
   * @var int
   * @column(allow_following)
   */
  private $allowFollowing;

  /**
   * @var int
   * @column(allow_notifications)
   */
  private $allowNotifications;

  /**
   * @var int
   * @column(allow_send_email)
   */
  private $allowSendEmail;

  /**
   * @var int
   * @column(allow_subscribe)
   */
  private $allowSubscribe;

  /**
   * @var string
   * @column(pay_settings)
   */
  private $paySettings;

  /**
   * @return int
   */
  function getId(): int
  {
    return $this -> id;
  }

  /**
   * @return \MVC\Models\User
   */
  function getUserId(): User
  {

    $repo = new Repository( User::class );

    return $repo -> findOneBy( [
        'id' => $this -> userId
      ] );
  }

  /**
   * @return int
   */
  function getAllowFollowing(): int
  {
    return $this -> allowFollowing;
  }

  /**
   * @return int
   */
  function getAllowNotifications(): int
  {
    return $this -> allowNotifications;
  }

  /**
   * @return int
   */
  function getAllowSendEmail(): int
  {
    return $this -> allowSendEmail;
  }

  /**
   * @return int
   */
  function getAllowSubscribe(): int
  {
    return $this -> allowSubscribe;
  }

  /**
   * @return string
   */
  function getPaySettings(): string
  {
    return $this -> paySettings;
  }

  /**
   * @param int $userId
   */
  function setUserId( int $userId )
  {
    $this -> userId = $userId;
  }

  /**
   * @param int $allowFollowing
   */
  function setAllowFollowing( int $allowFollowing )
  {
    $this -> allowFollowing = $allowFollowing;
  }

  /**
   * @param int $allowNotifications
   */
  function setAllowNotifications( int $allowNotifications )
  {
    $this -> allowNotifications = $allowNotifications;
  }

  /**
   * @param int $allowSendEmail
   */
  function setAllowSendEmail( int $allowSendEmail )
  {
    $this -> allowSendEmail = $allowSendEmail;
  }

  /**
   * @param int $allowSubscribe
   */
  function setAllowSubscribe( int $allowSubscribe )
  {
    $this -> allowSubscribe = $allowSubscribe;
  }

  /**
   * @param string $paySettings
   */
  function setPaySettings( string $paySettings )
  {
    $this -> paySettings = $paySettings;
  }

}
