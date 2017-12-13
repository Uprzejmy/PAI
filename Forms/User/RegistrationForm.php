<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class RegistrationForm extends Form implements IForm
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
    $this->valid = true;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getUsername()
  {
    return $this->username;
  }
}