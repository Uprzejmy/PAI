<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class TeamInviteForm extends Form implements IForm
{
  private $email;

  public function bindData()
  {
    $this->email = $this->bindProperty('email');
  }

  public function validateData()
  {
    $this->valid = $this->validateEmail();
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

  public function validateEmail() : bool
  {
    if(strlen($this->email) === 0)
    {
      return false;
    }

    return true;
  }
}