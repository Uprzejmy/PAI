<?php
/**
 * Created by Uprzejmy
 */

abstract class Form
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

  public function isValid()
  {
    return $this->valid;
  }

  public function getErrors()
  {
    return $this->errors;
  }
}