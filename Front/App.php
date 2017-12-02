<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/UrlValidatorService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/AuthenticationService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/AuthorizationService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/RouterService.php";


class App
{
  private static $instance;

  public static function getInstance()
  {
    if(self::$instance === null)
    {
      self::$instance = new App();
    }

    return self::$instance;
  }

  private function __construct(){}

  function run()
  {
    $this->successOrDie(UrlValidatorService::isUrlValid($_SERVER['REQUEST_URI']));
    $this->successOrDie(AuthenticationService::authenticate($_COOKIE));
    $this->successOrDie(RouterService::route($_SERVER['REQUEST_URI']));
  }

  function successOrDie($returnValue)
  {
    if($returnValue !== true)
    {
      die();
    }
  }

}