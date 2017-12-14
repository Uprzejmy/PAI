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
  public function loginAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $form = new LoginForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();

      if($form->isValid())
      {
        $model = new Model();

        if($model->loginUser($form->getEmail(), $form->getPassword()))
        {
          $this->redirect("/homepage");
        }
        else
        {
          $form->invalidateForm("Email and password mismatch");
        }
      }
    }

    $userView = new UserView();

    $userView->render('Login', [
      'session' => $session,
      'email' => $form->getEmail(),
      'form_errors' => $form->getErrors()
    ]);
  }

  public function logoutAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    if($session->isUserLogged())
    {
      $model = new Model();

      $model->logoutUser($session->getSessionKey());
    }

    $this->redirect("/homepage");
  }

  public function registrationAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $form = new RegistrationForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();

      if($form->isValid())
      {
        $model = new Model();

        if($model->registerUser($form->getEmail(), $form->getPassword(), $message))
        {
          $this->redirect("/homepage");
        }
        else
        {
          $form->invalidateForm($message);
        }
      }
    }

    $userView = new UserView();

    $userView->render('Registration', [
      'session' => $session,
      'email' => $form->getEmail(),
      'form_errors' => $form->getErrors()
    ]);
  }
}