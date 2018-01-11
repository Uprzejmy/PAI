<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class RegistrationForm extends Form implements IForm
{
  private $email;
  private $password;
  private $password2;

  public function bindData()
  {
    $this->email = $this->bindProperty('email');
    $this->password = $this->bindProperty('password');
    $this->password2 = $this->bindProperty('password2');
  }

  public function validateData()
  {
    $this->valid = true; //assume valid

    $this->validateEmail();
    $this->validatePassword();
    $this->validatePasswordsMatch();
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

  public function getPassword2()
  {
    return $this->password2;
  }


  private function validateEmail()
  {
    if(strlen($this->email) < 3)
    {
      $this->invalidateForm("Provided data is too short");
    }

    if(strlen($this->email) > 64)
    {
      $this->invalidateForm("Provided data is too long");
    }
  }

  private function validatePassword()
  {
    if(strlen($this->password) < 3 || strlen($this->password2) < 3)
    {
      $this->invalidateForm("Provided data is too short");
    }

    if(strlen($this->password) > 64 || strlen($this->password2) < 64)
    {
      $this->invalidateForm("Provided data is too long");
    }
  }

  private function validatePasswordsMatch()
  {
    if($this->password !== $this->password2)
    {
      $this->invalidateForm("password and confirmation don't match");
    }
  }
}