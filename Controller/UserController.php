<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/UserView.php";

class UserController
{
    public function loginAction()
    {
      $userView = new UserView();

      $userView->render('Login', ['testKey' => 'testValue']);
    }
}