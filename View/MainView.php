<?php
/**
 * Created by Uprzejmy
 */

class MainView
{
  public function render(IView $view)
  {
    echo("<!DOCTYPE html>
          <html>
          <body>
          ");

    include("MenuBar.php");
    include("UserBlock.php");

    echo("</body>
          </html>");
  }
}