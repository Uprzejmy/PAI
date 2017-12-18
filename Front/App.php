<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/RequestValidatorService.php";
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
    RequestValidatorService::validateRequest();
    $session = AuthenticationService::authenticate($_COOKIE);
    $route = RouterService::getRoute($_SERVER['REQUEST_URI']);

    if(AuthorizationService::isUserAuthorized($route, $session))
    {
      RouterService::runRoute($route, $session);
    }
    else
    {
      header("Location: /homepage", true, 303);
    }

    die();
  }

}