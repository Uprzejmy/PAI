<?php
/**
 * Created by Uprzejmy
 */

  //check if script has been run using console
  include("isConsole.php");

  include("connect.php");

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
