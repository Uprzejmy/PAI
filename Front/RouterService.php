<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/Controller.php";

class RouterService
{
  //TODO
  public static function route($url)
  {
      $controller = new Controller();
      $controller->action();

      return false;
  }

}