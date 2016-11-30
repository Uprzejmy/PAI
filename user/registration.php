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

    if(!isset($_POST['password2']))
    {
      $password2FieldError = "Pole Powtórz hasło nie może być puste";
      $anyFieldError = 1;
    }

    if(!isset($_POST['name']))
    {
      $nameFieldError = "Pole Imię nie może być puste";
      $anyFieldError = 1;
    }

    if(!isset($_POST['surname']))
    {
      $surnameFieldError = "Pole Nazwisko nie może być puste";
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

      if($user)
      {
        $emailFieldError = "Podany adres email jest zajęty";
        $anyFieldError = 1;
      }
    }

    //check if passwords match
    if(!$anyFieldError)
    {
      if($_POST['password'] !== $_POST['password2'])
      {
        $passwordFieldError = "Podane hasła się nie zgadzają";
        $anyFieldError = 1;
      }
    }

    //at this point input data met desired conditions, so we register the user
    if(!$anyFieldError)
    {
      $query = $mysqli->prepare("INSERT INTO users (email, password, name, surname) VALUES (?, ?, ?, ?)");
      $query->bind_param('ssss', $_POST['email'], password_hash($_POST['password'],PASSWORD_BCRYPT), $_POST['name'], $_POST['surname']); //'s' means that database expects string
      $query->execute();

      //redirect user to login after successful registration (make it homepage after automatic login)
      header('Location: ' . '/login');
    }
  }
?>

<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>
    <a href="/homepage">Homepage</a>
    <a href="/login">Login</a>

    <div class="login">
      <h1>Registration</h1>
      <?php
        if($anyFieldError)
          echo("<p>Błąd rejestracji</p>");
      ?> 
      <form action="/registration" method="POST">
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
        <input type="password" name="password2" placeholder="password confirmation"/>
        <input type="text" name="name" placeholder="name"/>
        <?php
          if(isset($nameFieldError))
            echo("<p>".$nameFieldError."</p>");
        ?>
        <input type="text" name="surname" placeholder="surname"/>
        <?php
          if(isset($surnameFieldError))
            echo("<p>".$surnameFieldError."</p>");
        ?>
        <input class="button" type="submit" value="Create an account"/>
      </form>
      
    </div>
    
  </body>
</html>


    