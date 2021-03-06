<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/ExamplesModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";

class MainController extends BaseController
{
  public function homepageAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $mainView = new MainView();

    $mainView->render('Homepage',[
      'session' => $session
    ]);
  }

  public function notFoundAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $mainView = new MainView();

    $mainView->render('NotFound',[
      'session' => $session
    ]);
  }

  public function loadExamplesAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    $model = new ExamplesModel();
    $model->loadExamples();

    $mainView = new MainView();

    $mainView->render('LoadExamples',[
      'session' => $session
    ]);
  }
}