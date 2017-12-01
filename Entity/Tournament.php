<?php
/**
 * Created by Uprzejmy
 */

class Tournament
{
  private $id;
  private $name;
  private $description;
  private $createdAt;
  private $admin;

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
  public function getAdmin(): User
  {
    return $this->admin;
  }

  /**
   * @param User $admin
   */
  public function setAdmin(User $admin)
  {
    $this->admin = $admin;
  }


}