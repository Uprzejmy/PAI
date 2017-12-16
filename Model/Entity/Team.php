<?php
/**
 * Created by Uprzejmy
 */

class Team
{
  private $id;
  private $name;
  private $description;
  private $createdAt;
  private $captain;
  private $number_of_members;

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


}