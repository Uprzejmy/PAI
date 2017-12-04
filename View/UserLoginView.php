<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/IView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class UserLoginView extends View implements IView
{
  function render()
  {
    include($this->templatesDir."UserLoginBlock.php");
  }
}