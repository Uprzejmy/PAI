<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";

class Controller
{
  public function action()
  {
    $model = new Model();
    $view = new MainView();
    $userView = new UserView();

    $view->render($userView);
  }
}