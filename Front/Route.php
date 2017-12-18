<?php
/**
 * Created by Uprzejmy
 */

class Route
{
  public $controller;
  public $action;
  public $requiresLogged;
  public $parameters;

  function __construct($controller, $action, $requiresLogged = true, $parameters = [])
  {
    $this->controller = $controller;
    $this->action = $action;
    $this->requiresLogged = $requiresLogged;
    $this->parameters = [];
    $this->parameters = array_merge($this->parameters + $parameters);
  }

  public function addParameter($key, $value)
  {
    $this->parameters[$key] = $value;
  }

}