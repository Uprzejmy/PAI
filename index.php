<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <meta charset="utf-8">
    <title>Homepage</title>
  </head>
  <body>
    <a href="/homepage">Homepage</a>
    <a href="/login">Login</a>
    <a href="/registration">Registration</a>

    <?php
      if(isset($_COOKIE['email']))
        echo("<p>Zalogowano jako: ".$_COOKIE['email']."</p>");
    ?>
  </body>
</html>