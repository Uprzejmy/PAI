<?php
/**
 * Created by Uprzejmy
 */

class View
{
  protected $templatesDir;

  public function __construct()
  {
    $this->templatesDir = $_SERVER['DOCUMENT_ROOT']."/View/Contents/";
  }
}