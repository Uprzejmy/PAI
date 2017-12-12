<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";

class MainController extends BaseController
{
  public function homepageAction()
  {
    $dbConnection = DbConnection::getInstance()->getConnection();
    $model = new Model();
    $users = $model->getAllUsers($dbConnection);
    $user = $model->getUserById($dbConnection, 1);

    $mainView = new MainView();

    $mainView->render('Homepage');
  }

  public function notFoundAction()
  {
    $mainView = new MainView();

    $mainView->render('NotFound');
  }
}