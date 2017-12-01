<?php
/**
 * Created by Uprzejmy
 */

  //check if script has been run using console
  if(php_sapi_name() != "cli")
  {
    header('Location: ' . '/index.php');
  }

?>