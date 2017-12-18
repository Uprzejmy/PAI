<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/RoutingTable.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/MainController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/UserController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/AccountController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/TeamController.php";
//TODO include all controllers

class RouterService
{
  public static function route($url, UserSession $session)
  {
    $routingTable = new RoutingTable();

    $splitUrl = self::grabNumberParameter($url);

    $route = $routingTable->matchRoute($splitUrl[0]);
    if(isset($splitUrl[1]))
    {
      $route->addParameter('id', $splitUrl[1]);
    }

    $route->addParameter('session', $session);

    call_user_func(array(new $route->controller, $route->action), $route->parameters);

    return false;
  }


  public static function grabNumberParameter($url)
  {
    $splitUrl = [];
    $splitUrl[0] = ""; //just to be cautious
    $parts = explode("/", $url);
    unset($parts[0]); //every url starts with a '/' sign, so we need to remove first element - empty string

    foreach($parts as $part)
    {
      if(preg_match('/\\d/', $part) > 0)
      {
        $splitUrl[1] = $part;
      }
      else
      {
        $splitUrl[0] = $splitUrl[0]."/".$part;
      }
    }

    return $splitUrl;
  }


}