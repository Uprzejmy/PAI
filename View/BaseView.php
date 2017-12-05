<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class BaseView extends View
{
  public function render(IView $view, $action, $parameters = [])
  {
    echo("<!DOCTYPE html>
          <html>
          <body>
          ");

    include($this->templatesDir."MenuBar.php");
    $view->renderContent($action, $parameters);

    echo("</body>
          </html>");
  }
}