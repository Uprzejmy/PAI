<?php

//check if script has been run using console
include("isConsole.php");

include("connect.php");

//example data
$adminPassword = password_hash("admin",PASSWORD_DEFAULT);
$query = "INSERT INTO users (email, password, name, surname) VALUES ('admin', '".$adminPassword."', 'admin', 'admin')";

$result = $mysqli->query($query);

echo "$query\n";

if($mysqli->connect_errno)
{
  echo("Can't execute query\r\n");
  die();
}

?>