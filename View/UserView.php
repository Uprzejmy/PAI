<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/View/IView.php";

class UserView implements IView
{
  function render()
  {
    include("UserBlock.php");
  }
}