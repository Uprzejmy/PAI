<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class BaseView extends View
{
  public function render(IView $view, $action, $parameters = [])
  {
    echo("<!DOCTYPE html><html><head><link href=/styles.css rel=\"stylesheet\" type=\"text/css\" media=\"all\" /></head><body>");

    include($this->templatesDir."HeaderMenuBar.php");
    $view->renderContent($action, $parameters);

    echo("</body></html>");
  }
}