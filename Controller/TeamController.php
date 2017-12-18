<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";

class TeamController extends BaseController
{
  public function showTeamAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];


    var_dump($parameters);
    /*
    $form = new LoginForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();

      if($form->isValid())
      {
        $model = new UserModel();

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
    */
  }

}