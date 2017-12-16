<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/LoginForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/RegistrationForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/AccountView.php";

class AccountController extends BaseController
{
  public function showAccountTournamentsAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $accountView = new AccountView();

    $accountView->render('Tournaments', [
      'session' => $session
    ]);
  }

  public function showAccountTeamsAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $accountView = new AccountView();

    $accountView->render('Teams', [
      'session' => $session
    ]);
  }
}