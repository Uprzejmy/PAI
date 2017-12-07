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
    return true;
  }

  public function getEmail()
  {
    return $this->email;
  }
}