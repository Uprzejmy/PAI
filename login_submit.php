<?php

  //if there is no data 
  if(!isset($_POST['email']) || !isset($_POST['password']))
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

  if(!password_verify($_POST['password'],$user['password']))
  {
    setcookie('loginFormError','login and password mismatch',0);

    //redirect user to login page
    header('Location: ' . 'login.php');
    die(); 
  }

  echo("uzytkownik zalogowany");
  var_dump($user);

  // echo("uzytkownik zalogowany");
  // var_dump($user);

  // $query = $mysqli->prepare("UPDATE users SET session_key = 'tarearegsrgsr' WHERE `users`.`id` = 4 ");

  // $query->bind_param('s', $_POST['email']); //'s' means that database expects string
  // $query->execute();

  // password_hash($user->password);
  // password_verify()



?>