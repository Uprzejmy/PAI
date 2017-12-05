<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class MainView extends View
{
  public function render(IView $view, $parameters = [])
  {
    echo("<!DOCTYPE html>
          <html>
          <body>
          ");

    include($this->templatesDir."MenuBar.php");
    $view->renderContent($parameters);

    echo("</body>
          </html>");
  }
}