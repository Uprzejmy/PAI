<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Utils.php";

class Tournament
{
  private $id;
  private $name;
  private $description;
  private $created_at;
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
    return $this->created_at;
  }

  /**
   * @param mixed $created_at
   */
  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }

  public function getPrintableCreatedAt()
  {
    return Utils::getDateFromStringDatetime($this->created_at);
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