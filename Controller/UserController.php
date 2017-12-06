<?php
/**
 * Created by Uprzejmy
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/LoginForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/User/RegistrationForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";

class UserController extends BaseController
{
  public function loginAction()
  {
    $form = new LoginForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();
    }

    $userView = new UserView();

    $userView->render('Login', [
      'email' => $form->getEmail()
    ]);
  }

  public function logoutAction()
  {
    //TODO clear session and others
    $this->redirect("/homepage");
  }

  public function registrationAction()
  {
    $form = new RegistrationForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();
    }

    $userView = new UserView();

    $userView->render('Registration', [
      'email' => $form->getEmail(),
      'username' => $form->getUsername()
      ]);
  }
}