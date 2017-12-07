<?php
/**
 * Created by Uprzejmy
 */

abstract class Form
{
  protected function bindProperty($property)
  {
    if(isset($_POST[$property]))
    {
      return $_POST[$property];
    }

    return "";
  }
}