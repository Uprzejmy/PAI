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
    $this->parameters = [];
    $this->parameters = array_merge($this->parameters + $parameters);
  }

  public function addParameter($key, $value)
  {
    $this->parameters[$key] = $value;
  }

}