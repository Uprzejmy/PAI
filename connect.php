<?php
  include("parameters.php");
  
  $mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

  if($mysqli->connect_errno)
  {
  	die("Failed to connect to database server.\r\n");
  }
  else
  {
  	echo "Connected to database server.\r\n";
  }

  $mysqli->set_charset('utf8');
    
?>