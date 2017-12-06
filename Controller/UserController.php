<?php
/**
 * Created by Uprzejmy
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";

class UserController extends BaseController
{
  public function loginAction()
  {


    $userView = new UserView();

    $userView->render('Login', ['testKey' => 'testValue']);
  }

  public function logoutAction()
  {
    //TODO clear session and others
    $this->redirect("/homepage");
  }

  public function registrationAction()
  {


    $userView = new UserView();

    $userView->render('Registration', ['testKey' => 'testValue']);
  }
}