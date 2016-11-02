<?php
  include("parameters.php");
  
  $mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName)
    or die("There is no connection to MySQL server.\r\n");
?>