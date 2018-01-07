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
  private $admin_id;

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
   * @return mixed
   */
  public function getAdminId()
  {
    return $this->admin_id;
  }

  /**
   * @param mixed $adminId
   */
  public function setAdminId($adminId)
  {
    $this->admin_id = $adminId;
  }

  public function isAdmin($userId) : bool
  {
    if($this->admin_id === $userId)
    {
      return true;
    }

    return false;
  }


}