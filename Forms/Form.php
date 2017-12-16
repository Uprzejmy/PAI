<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";

abstract class Form implements IForm
{
  protected $valid = false;
  protected $errors = array();

  protected function bindProperty($property)
  {
    if(isset($_POST[$property]))
    {
      return $_POST[$property];
    }

    return "";
  }

  public abstract function bindData();
  public abstract function validateData();

  public function isValid()
  {
    return $this->valid;
  }

  public function getErrors()
  {
    return $this->errors;
  }
}