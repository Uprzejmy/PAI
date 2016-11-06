<?php
  include("connect.php");

  //if there is no data 
  if(!isset($_POST["email"]) || !isset($_POST["password"]))
    header('Location: ' . 'index.php');

  //$query = "SELECT id, email, password, name, surname FROM users WHERE email = \"".$_POST['email']."\"";
  $query = "INSERT INTO users (email, password, salt, name, surname) VALUES ("test", "test", "test", "test", "test")";

  $result = $mysqli->query($query);

  if($mysqli->connect_errno)
  {
    echo("Can't get user info\r\n");
    die();
  }

  // if($result === false)
  // {
  //   echo("Can't get user info\r\n");
  //   die();
  // }

  // var_dump($result);
  // $row = mysqli_fetch_array($result);
  // var_dump($row);
  // die();
  //check if user with submitted email exists
  if(!isset($row['id']))
  {
    header('Location: ' . 'login.php');
    die();
  }

  header('Location: ' . 'index.php');
  die();


?>