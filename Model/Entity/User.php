<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Utils.php";

class User
{
  private $id;
  private $email;
  private $password;
  private $name;
  private $surname;
  private $registered_at;
  private $joined_at;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
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
  public function getSurname()
  {
    return $this->surname;
  }

  /**
   * @param mixed $surname
   */
  public function setSurname($surname)
  {
    $this->surname = $surname;
  }

  /**
   * @return mixed
   */
  public function getRegisteredAt()
  {
    return $this->registered_at;
  }

  /**
   * @param mixed $registered_at
   */
  public function setRegisteredAt($registered_at)
  {
    $this->registered_at = $registered_at;
  }

  public function getPrintableRegisteredAt()
  {
    return Utils::getDateFromStringDatetime($this->registered_at);
  }

  /**
   * @return mixed
   */
  public function getJoinedAt()
  {
    return $this->joined_at;
  }

  /**
   * @param mixed $joined_at
   */
  public function setJoinedAt($joined_at)
  {
    $this->joined_at = $joined_at;
  }

  public function getPrintableJoinedAt()
  {
    return Utils::getDateFromStringDatetime($this->joined_at);
  }

}