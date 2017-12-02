<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class MainView extends View
{
  public function __construct()
  {
    parent::__construct();
  }

  public function render(IView $view)
  {
    echo("<!DOCTYPE html>
          <html>
          <body>
          ");

    include($this->templatesDir."MenuBar.php");
    $view->render();

    echo("</body>
          </html>");
  }
}