<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class TeamCreateForm extends Form implements IForm
{
  private $name;

  public function bindData()
  {
    $this->name = $this->bindProperty('name');
  }

  public function validateData()
  {
    $this->valid = true;

    $this->validateName();
  }

  public function invalidateForm($message = "")
  {
    $this->errors[] = $message;
    $this->valid = false;
  }

  public function getName()
  {
    return $this->name;
  }

  private function validateName()
  {
    if(strlen($this->name) < 3)
    {
      $this->invalidateForm("Provided data is too short");
    }

    if(strlen($this->name) > 64)
    {
      $this->invalidateForm("Provided data is too long");
    }
  }
}