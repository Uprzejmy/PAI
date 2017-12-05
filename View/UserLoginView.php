<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/IView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/MainView.php";

class UserLoginView extends View implements IView
{
  function render($parameters = [])
  {
    $mainView = new MainView();
    $mainView->render($this, $parameters);
  }

  function renderContent($parameters)
  {
    include($this->templatesDir."UserLoginBlock.php");
  }
}