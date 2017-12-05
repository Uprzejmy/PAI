<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";

class Controller
{
  public function homepageAction()
  {
    $mainView = new MainView();

    $mainView->render('Homepage');
  }

  public function notFoundAction()
  {
    $mainView = new MainView();

    $mainView->render('NotFound');
  }
}