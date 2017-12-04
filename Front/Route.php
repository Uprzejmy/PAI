<?php
/**
 * Created by Uprzejmy
 */

class Route
{
  public $controller;
  public $action;
  public $parameters;

  function __construct($controller, $action, $parameters = [])
  {
    $this->controller = $controller;
    $this->action = $action;
    $this->parameters = $parameters;
  }

}