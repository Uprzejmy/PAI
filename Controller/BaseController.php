<?php
/**
 * Created by Uprzejmy
 */

require_once ($_SERVER['DOCUMENT_ROOT']."/Front/App.php");

class BaseController
{
  protected function redirect($url)
  {
    header("Location: $url", true, 301);
    die();
  }
}