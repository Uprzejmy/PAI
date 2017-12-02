<?php
/**
 * Created by Uprzejmy
 */

class User
{
  private $id;
  private $email;
  private $password;
  private $name;
  private $surname;
  private $registeredAt;

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
    return $this->registeredAt;
  }

  /**
   * @param mixed $registeredAt
   */
  public function setRegisteredAt($registeredAt)
  {
    $this->registeredAt = $registeredAt;
  }



}