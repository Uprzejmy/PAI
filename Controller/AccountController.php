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
  public function showAccountAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $accountView = new AccountView();

    $accountView->render('Show', [
      'session' => $session
    ]);
  }
}