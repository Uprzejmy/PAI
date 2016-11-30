<?php
  //allows to use root variable instead of $_SERVER["DOCUMENT_ROOT"]
  require($_SERVER["DOCUMENT_ROOT"]."/env.php");

  //if there is any data 
  if(isset($_POST['email']) && isset($_POST['password']))
  {
    include($root."/connect.php");

    $query = $mysqli->prepare("SELECT id, email, password, name, surname FROM users WHERE email = ?");

    $query->bind_param('s', $_POST['email']); //'s' means that database expects string
    $query->execute();

    $result = $query->get_result();
    $user = $result->fetch_assoc();

    //if user with such email doesn't exists
    if($user == false)
    {
      setcookie('loginFormError','login and password mismatch',0);

      //redirect user to login page
      header('Location: ' . '/login');
      die();
    }

    //if password for such user doesn't match
    if(!password_verify($_POST['password'],$user['password']))
    {
      setcookie('loginFormError','login and password mismatch',0);

      //redirect user to login page
      header('Location: ' . '/login');
      die(); 
    }

    //if everything worked fine redirect user to homepage
    header('Location: ' . '/homepage');
  }

?>

<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <a href="/homepage">Homepage</a>
    <a href="/registration">Registration</a>

    <div class="login">
      <h1>Login</h1>
      <?php
        if(isset($_COOKIE["loginFormError"]))
          echo("<p>".$_COOKIE["loginFormError"]."</p>");
        setcookie("loginFormError", "", time() - 3600); //time in the past tells browser to remove the cookie
      ?> 
      <form action="/login" method="POST">
        <input type="text" name="email" placeholder="email"/>
        <input type="password" name="password" placeholder="password"/>
        <input class="button" type="submit" value="Login"/>
      </form>
      
    </div>
    
  </body>
</html>