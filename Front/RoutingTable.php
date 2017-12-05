<?php
/**
 * Created by Uprzejmy
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/Route.php";

class RoutingTable
{
  private $routes;

  function __construct()
  {
    $this->initializeRoutingTable();
  }

  public function getRoute($url) : Route
  {
    if(isset($this->routes[$url]))
    {
      return $this->routes[$url];
    }

    return $this->routes['/not_found'];
  }

  private function initializeRoutingTable()
  {
    $this->routes['/not_found'] = new Route("Controller", "notFoundAction");
    $this->routes['/login'] = new Route("UserController", "loginAction");
    $this->routes['/homepage'] = new Route("Controller", "homepageAction");

    //TODO configure other routes
  }

}
