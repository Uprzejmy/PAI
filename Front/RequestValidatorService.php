<?php

  function successOrDie($returnValue)
  {
    if($returnValue !== true)
    {
      die();
    }
  }
/**
 * Created by Uprzejmy
 */

class RequestValidatorService
{
  public static function validateRequest()
  {
    foreach($_POST as $key => $value)
    {
      $safeKey = htmlentities(trim($key), ENT_NOQUOTES);
      $_POST[$safeKey] = htmlentities(trim($value), ENT_NOQUOTES);
    }

    foreach($_COOKIE as $key => $value)
    {
      $safeKey = htmlentities(trim($key), ENT_NOQUOTES);
      $_COOKIE[$safeKey] = htmlentities(trim($value), ENT_NOQUOTES);
    }
  }
}