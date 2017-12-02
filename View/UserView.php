<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/IView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/View.php";

class UserView extends View implements IView
{

  function render()
  {
    include($this->templatesDir."UserBlock.php");
  }
}