<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/UrlValidatorService.php";

class App
{
  public $USER;
  public $ROOT;
  public $APP;

  function __construct()
  {
    $ROOT = $_SERVER['DOCUMENT_ROOT'];
    $APP = $this;
  }

  function run($url)
  {
    UrlValidatorService::isUrlValid($url);


  }

  function redirect

}