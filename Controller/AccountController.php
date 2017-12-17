<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/AccountModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/LoginForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/RegistrationForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/AccountView.php";

class AccountController extends BaseController
{
  public function showAccountTournamentsAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $accountModel = new AccountModel();
    $tournaments = $accountModel->getUserTournaments($session->getUserId());

    $accountView = new AccountView();

    $accountView->render('Tournaments', [
      'session' => $session,
      'tournaments' => $tournaments
    ]);
  }

  public function showAccountTeamsAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $accountModel = new AccountModel();
    $teams = $accountModel->getUserTeams($session->getUserId());

    //TODO team invites

    $accountView = new AccountView();

    $accountView->render('Teams', [
      'session' => $session,
      'teams' => $teams
    ]);
  }
}