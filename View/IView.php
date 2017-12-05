<?php
/**
 * Created by Uprzejmy
 */

interface IView
{
  function render($action, $parameters = []);
  function renderContent($action, $parameters);
}