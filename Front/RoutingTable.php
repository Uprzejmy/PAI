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
    $this->routes['/homepage'] = new Route("AccountController", "showLatestTournamentsAction", false);

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
    $this->routes['/team/admin/{{number}}'] = new Route("TeamController", "showTeamMembersAdministrationAction", true);
    $this->routes['/team/members/remove'] = new Route("TeamController", "removeMemberFromTeamAction", true);
    $this->routes['/team/self_remove'] = new Route("TeamController", "selfRemoveFromTeamAction", true);
    $this->routes['/team/invite/accept'] = new Route("TeamController", "acceptTeamInvitationAction", true);
    $this->routes['/team/invite/send'] = new Route("TeamController", "sendTeamInvitationAction", true);
    $this->routes['/team/invite/remove'] = new Route("TeamController", "removeTeamInvitationAction", true);
    $this->routes['/team/create'] = new Route("TeamController", "createTeamAction", true);

    //Tournaments
    $this->routes['/tournaments/{{number}}'] = new Route("TournamentController", "showTournamentAction", false);
    $this->routes['/tournaments/matches/{{number}}'] = new Route("TournamentController", "showTournamentMatchesAction", false);
    $this->routes['/tournaments/admin/participants/{{number}}'] = new Route("TournamentController", "showTournamentAdminParticipantsAction", true);
    $this->routes['/tournaments/admin/settings/{{number}}'] = new Route("TournamentController", "showTournamentAdminSettingsAction", true);
    $this->routes['/tournaments/join/{{number}}'] = new Route("TournamentController", "joinTournamentAction", true);
    $this->routes['/tournaments/create'] = new Route("TournamentController", "createTournamentAction", true);
    $this->routes['/tournaments/remove_team'] = new Route("TournamentController", "removeTeamFromTournamentAction", true);
    $this->routes['/tournaments/start'] = new Route("TournamentController", "startTournamentAction", true);

    //TODO check if requested resource id exists and redirect the user if it doesn't
    //TODO configure other routes
  }

}
