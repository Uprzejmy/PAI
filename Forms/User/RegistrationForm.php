<?php
/**
 * Created by Uprzejmy
 */

class RegistrationForm
{
  private $email;
  private $username;
  private $password;
  private $password2;

  public function bindData()
  {
    $this->email = $this->bindProperty('email');
    $this->username = $this->bindProperty('username');
    $this->password = $this->bindProperty('password');
    $this->password2 = $this->bindProperty('password2');
  }

  public function validateData()
  {
    return true;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getUsername()
  {
    return $this->username;
  }

  private function bindProperty($property)
  {
    if(isset($_POST[$property]))
    {
      return $_POST[$property];
    }

    return "";
  }

}