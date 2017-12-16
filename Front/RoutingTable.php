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
    //Main
    $this->routes['/not_found'] = new Route("MainController", "notFoundAction");
    $this->routes['/homepage'] = new Route("MainController", "homepageAction");

    //User
    $this->routes['/login'] = new Route("UserController", "loginAction");
    $this->routes['/registration'] = new Route("UserController", "registrationAction");
    $this->routes['/logout'] = new Route("UserController", "logoutAction");

    //Account
    $this->routes['/account'] = new Route("AccountController", "showAccountAction");

    //TODO configure other routes
  }

}
