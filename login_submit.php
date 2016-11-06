<?php

  //if there is no data 
  if(!isset($_POST["email"]) || !isset($_POST["password"]))
  {
    //redirect user to login page
    header('Location: ' . 'login.php');
    die();
  }

  include("connect.php");

  $query = $mysqli->prepare("SELECT id, email, password, name, surname FROM users WHERE email = ?");


  $query->bind_param('s', $_POST['email']); //'s' means that database expects string
  $query->execute();

  $result = $query->get_result();
  $user = $result->fetch_assoc();

  if($user == false)
  {
    setcookie('loginFormError','login and password mismatch',0);

    //redirect user to login page
    header('Location: ' . 'login.php');
    die();
  }

  echo("uzytkownik zalogowany");

  // var_dump($result);
  // $row = mysqli_fetch_array($result);
  // var_dump($row);
  // die();
  //check if user with submitted email exists
  // if(!isset($row['id']))
  // {
  //   header('Location: ' . 'login.php');
  //   die();
  // }

  // header('Location: ' . 'index.php');
  // die();


?>