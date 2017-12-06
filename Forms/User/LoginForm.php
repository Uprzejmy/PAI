<?php
/**
 * Created by Uprzejmy
 */

class LoginForm
{
  private $email;
  private $password;

  public function bindData()
  {
    $this->email = $this->bindProperty('email');
    $this->password = $this->bindProperty('password');
  }

  public function validateData()
  {
    return true;
  }

  public function getEmail()
  {
    return $this->email;
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