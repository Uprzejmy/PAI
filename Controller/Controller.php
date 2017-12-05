<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";

class Controller
{
  public function action()
  {
    $model = new Model();

    $userView = new UserView();

    $userView->render();
  }

  public function notFoundAction()
  {
    $userView = new UserView();

    $userView->render();
  }
}