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

  public function matchRoute($url) : Route
  {
    if(isset($this->routes[$url]))
    {
      return $this->routes[$url];
    }

    return $this->routes['/not_found'];
  }

  private function initializeRoutingTable()
  {
    $this->routes['/load_examples'] = new Route("MainController", "loadExamplesAction", false);

    //Main
    $this->routes['/not_found'] = new Route("MainController", "notFoundAction", false);
    $this->routes['/homepage'] = new Route("MainController", "homepageAction", false);

    //User
    $this->routes['/login'] = new Route("UserController", "loginAction", false);
    $this->routes['/registration'] = new Route("UserController", "registrationAction", false);
    $this->routes['/logout'] = new Route("UserController", "logoutAction", false);

    //Account
    $this->routes['/account'] = new Route("AccountController", "showAccountTournamentsAction", true);
    $this->routes['/account/tournaments'] = new Route("AccountController", "showAccountTournamentsAction", true);
    $this->routes['/account/teams'] = new Route("AccountController", "showAccountTeamsAction", true);

    //Teams
    $this->routes['/team/tournaments/{{number}}'] = new Route("TeamController", "showTeamTournamentsAction", true);
    $this->routes['/team/members/{{number}}'] = new Route("TeamController", "showTeamMembersAction", true);

    //TODO configure other routes
  }

}
