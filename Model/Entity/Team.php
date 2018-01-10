<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Utils.php";

class Team
{
  private $id;
  private $name;
  private $description;
  private $createdAt;
  private $captain;
  private $number_of_members;
  private $invited_at;
  private $joinedAt;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }

  /**
   * @return User
   */
  public function getCaptain() : User
  {
    return $this->captain;
  }

  /**
   * @param User $captain
   */
  public function setCaptain(User $captain)
  {
    $this->captain = $captain;
  }

  /**
   * @return mixed
   */
  public function getNumberOfMembers()
  {
    return $this->number_of_members;
  }

  /**
   * @param mixed $number_of_members
   */
  public function setNumberOfMembers($number_of_members)
  {
    $this->number_of_members = $number_of_members;
  }

  /**
   * @return mixed
   */
  public function getInvitedAt()
  {
    return $this->invited_at;
  }

  /**
   * @param mixed $invited_at
   */
  public function setInvitedAt($invited_at)
  {
    $this->invited_at = $invited_at;
  }

  /**
   * @return mixed
   */
  public function getJoinedAt()
  {
    return $this->joinedAt;
  }

  /**
   * @param mixed $joinedAt
   */
  public function setJoinedAt($joinedAt)
  {
    $this->joinedAt = $joinedAt;
  }

  public function getPrintableJoinedAt()
  {
    return Utils::getDateFromStringDatetime($this->joinedAt);
  }
}