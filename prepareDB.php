<?php
/**
 * Created by Uprzejmy
 */

  //check if script has been run using console
  include("isConsole.php");

  include("parameters.php");

  $mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
  if($mysqli->connect_errno)
  {
    die("Failed to connect to database server.\r\n");
  }
  $mysqli->set_charset('utf8');

  //drop existing database to be sure tables doesn't exists at start
  $dropQuery = 'DROP DATABASE '.$dbName;
  $result = $mysqli->query($dropQuery);
  if($mysqli->connect_errno)
  {
    die("Failed to connect to database server.\r\n");
  }

  $createQuery = 'CREATE DATABASE '.$dbName;
  $result = $mysqli->query($createQuery);
  if($mysqli->connect_errno)
  {
    die("Failed to connect to database server.\r\n");
  }

?>
