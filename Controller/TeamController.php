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
    //TODO don't show admin in managable users, separate query?
    foreach($members as $key=>$member)
    {
      if($member->getId() === $session->getUserId())
      {
        unset($members[$key]);
      }
    }

    $teamView = new TeamView();

    $teamView->render('Admin', [
      'session' => $session,
      'teamId' => $teamId,
      'isUserAdmin' => $isUserAdmin,
      'members' => $members
    ]);
  }

  public function selfRemoveFromTeamAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $_POST['teamId'];

    $teamModel = new TeamModel();

    //TODO enhance hint to not self-remove from team when admin
    if($teamModel->isUserAdminInTeam($teamId, $session->getUserId()))
    {
      $this->redirect("/account/teams");
    }

    if($teamModel->isUserInTeam($teamId, $session->getUserId()))
    {
      $teamModel->removeMemberFromTeam($teamId, $session->getUserId());
    }

    $this->redirect("/account/teams");
  }

  public function removeMemberFromTeamAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $_POST['teamId'];
    $userId = $_POST['userId'];

    $teamModel = new TeamModel();

    if(!$teamModel->isUserAdminInTeam($teamId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    if(!$teamModel->isUserInTeam($teamId, $userId))
    {
      $this->redirect("/homepage");
    }

    if($session->getUserId() === $userId)
    {
      $this->redirect("/team/admin/$teamId");
    }

    $teamModel->removeMemberFromTeam($teamId, $userId);

    $this->redirect("/team/admin/$teamId");
  }

  public function acceptTeamInvitationAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $_POST['teamId'];
    $userId = $session->getUserId();

    $teamModel = new TeamModel();

    //just in case
    if($teamModel->isUserInTeam($teamId, $userId))
    {
      $this->redirect("/account/teams");
    }

    $accountModel = new AccountModel();
    $accountModel->acceptTeamInvitation($teamId, $userId);

    $this->redirect("/account/teams");
  }

  public function sendTeamInvitationAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $_POST['teamId'];
    $userEmail = $_POST['email'];
    $userId = $session->getUserId();

    $teamModel = new TeamModel();

    if(!$teamModel->isUserAdminInTeam($teamId, $userId))
    {
      $this->redirect("/account/teams");
    }

    $teamModel->sendInvitationToUser($teamId, $userEmail);

    $this->redirect("/team/admin/$teamId");
  }
}