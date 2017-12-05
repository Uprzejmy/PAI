<?php
/**
 * Created by Uprzejmy
 */

interface IView
{
  function render($parameters = []);
  function renderContent($parameters);
}