<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserLoginView.php";

class UserController
{
    public function loginAction()
    {
      $mainView = new MainView();
      $userLoginView = new UserLoginView();

      $mainView->render($userLoginView);
    }
}