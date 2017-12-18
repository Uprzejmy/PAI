<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/TeamModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/TeamView.php";

class TeamController extends BaseController
{
  public function showTeamTournamentsAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $parameters['id'];

    $teamModel = new TeamModel();

    if(!$teamModel->isUserInTeam($teamId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $isUserAdmin = false;
    if($teamModel->isUserAdminInTeam($teamId, $session->getUserId()))
    {
      $isUserAdmin = true;
    }

    $tournaments = $teamModel->getTeamTournaments($teamId);

    $teamView = new TeamView();

    $teamView->render('Tournaments', [
      'session' => $session,
      'teamId' => $teamId,
      'isUserAdmin' => $isUserAdmin,
      'tournaments' => $tournaments
    ]);
  }

  public function showTeamMembersAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $parameters['id'];

    $teamModel = new TeamModel();

    if(!$teamModel->isUserInTeam($teamId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $isUserAdmin = false;
    if($teamModel->isUserAdminInTeam($teamId, $session->getUserId()))
    {
      $isUserAdmin = true;
    }

    $members = $teamModel->getTeamMembers($teamId);

    $teamView = new TeamView();

    $teamView->render('Members', [
      'session' => $session,
      'teamId' => $teamId,
      'isUserAdmin' => $isUserAdmin,
      'members' => $members
    ]);
  }

  public function showTeamMembersAdministrationAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $parameters['id'];

    $teamModel = new TeamModel();

    if(!$teamModel->isUserAdminInTeam($teamId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $isUserAdmin = true;

    $members = $teamModel->getTeamMembers($teamId);

    $teamView = new TeamView();

    $teamView->render('Admin', [
      'session' => $session,
      'teamId' => $teamId,
      'isUserAdmin' => $isUserAdmin,
      'members' => $members
    ]);
  }

}