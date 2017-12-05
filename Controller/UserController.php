<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserLoginView.php";

class UserController
{
    public function loginAction()
    {
      $userLoginView = new UserLoginView();

      $userLoginView->render(['testKey' => 'testValue']);
    }
}