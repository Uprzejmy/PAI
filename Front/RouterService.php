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
  public static function route($url)
  {
    $routingTable = new RoutingTable();

    $route = $routingTable->getRoute($url);

    call_user_func_array(array(new $route->controller, $route->action), $route->parameters);

    return false;
  }

}