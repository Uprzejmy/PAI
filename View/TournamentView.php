<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/IView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/BaseView.php";

class TournamentView extends View implements IView
{
  function render($action, $parameters = [])
  {
    $baseView = new BaseView();
    $baseView->render($this, $action, $parameters);
  }

  function renderContent($action, $parameters)
  {
    include($this->templatesDir."Tournament/$action.php");
  }
}