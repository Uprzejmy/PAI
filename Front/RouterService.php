<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/RoutingTable.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/MainController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/UserController.php";
//TODO include all controllers

class RouterService
{
  public static function route($url, UserSession $session)
  {
    $routingTable = new RoutingTable();

    $route = $routingTable->getRoute($url);
    $route->addParameter('session', $session);

    call_user_func(array(new $route->controller, $route->action), $route->parameters);

    return false;
  }

}