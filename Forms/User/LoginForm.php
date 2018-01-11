<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class LoginForm extends Form implements IForm
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
    $this->valid = true;

    $this->validateEmail();
    $this->validatePassword();
  }

  public function invalidateForm($message = "")
  {
    $this->errors[] = $message;
    $this->valid = false;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  private function validateEmail()
  {
    if(strlen($this->email) < 3)
    {
      $this->invalidateForm("Provided data is too short");
    }

    if(strlen($this->email) >64)
    {
      $this->invalidateForm("Provided data is too long");
    }
  }

  private function validatePassword()
  {
    if(strlen($this->password) < 3)
    {
      $this->invalidateForm("Provided data is too short");
    }

    if(strlen($this->password) > 64)
    {
      $this->invalidateForm("Provided data is too long");
    }
  }
}