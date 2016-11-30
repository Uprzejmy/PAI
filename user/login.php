<?php
  $anyFieldError = 0;

  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        //allows to use root variable instead of $_SERVER["DOCUMENT_ROOT"]
    require($_SERVER["DOCUMENT_ROOT"]."/env.php");

    if(!isset($_POST['email']))
    {
      $emailFieldError = "Pole Email nie może być puste";
      $anyFieldError = 1;
    }

    if(!isset($_POST['password']))
    {
      $passwordFieldError = "Pole Haslo nie może być puste";
      $anyFieldError = 1;
    }

    //check if user with such email exists
    if(!$anyFieldError)
    {
      include($root."/connect.php");

      $query = $mysqli->prepare("SELECT id, email, password, name, surname FROM users WHERE email = ?");

      $query->bind_param('s', $_POST['email']); //'s' means that database expects string
      $query->execute();

      $result = $query->get_result();
      $user = $result->fetch_assoc();

      //if user with such email doesn't exists
      if(!$user)
      {
        $emailFieldError = "Nie istnieje użytkownik o podanych adresie Email";
        $anyFieldError = 1;
      }
    }

    //check if password is correct
    if(!$anyFieldError)
    {
      //if password for such user doesn't match
      if(!password_verify($_POST['password'],$user['password']))
      {
        $emailFieldError = "Nie istnieje użytkownik o podanych adresie Email";
        $anyFieldError = 1;
      }
    }

    //if everything worked fine redirect user to homepage and remember his email
    if(!$anyFieldError)
    {
      setcookie("email", $user['email'], time()+3600);
      header('Location: ' . '/homepage');
    }
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
        if($anyFieldError)
          echo("<p>Błąd logowania</p>");
      ?> 
      <form action="/login" method="POST">
        <input type="text" name="email" placeholder="email"/>
        <?php
          if(isset($emailFieldError))
            echo("<p>".$emailFieldError."</p>");
        ?> 
        <input type="password" name="password" placeholder="password"/>
        <?php
          if(isset($passwordFieldError))
            echo("<p>".$passwordFieldError."</p>");
        ?> 
        <input class="button" type="submit" value="Login"/>
      </form>
      
    </div>
    
  </body>
</html>