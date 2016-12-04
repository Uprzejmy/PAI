<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
?>

<?php
  if(isset($_COOKIE['email']) && isset($_COOKIE['session_key']) && isset($_COOKIE['previous']))
  {
    require($_SERVER["DOCUMENT_ROOT"]."/env.php");
    include($root."/connect.php");

    $query = $mysqli->prepare("SELECT id, previous FROM sessions WHERE session_key=?");

    $query->bind_param('s', $_COOKIE['session_key']);
    $query->execute();

    $result = $query->get_result();
    $session = $result->fetch_assoc();

    if($_COOKIE['previous'] != $session['previous'])
    {
      echo("usunac sesje");
    }

    $previous = rand(0,100);

    $query = $mysqli->prepare("UPDATE sessions SET previous=? WHERE session_key=?");

    $query->bind_param('ss', $previous, $_COOKIE['session_key']);
    $query->execute();

    setcookie("previous", $previous, time()+3600, "/");

    echo($previous."</br>");
  }
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <meta charset="utf-8">
    <title>Homepage</title>
  </head>
  <body>
    <a href="/homepage">Homepage</a>
    <a href="/login">Login</a>
    <a href="/logout">Logout</a>
    <a href="/registration">Registration</a>
    <div class="example">
    <?php
      if(isset($_COOKIE['email']))
        echo("<p>Zalogowano jako: ".$_COOKIE['email']."</p>");
      else
        echo("<p>niezalogowano</p>");
      if(isset($_COOKIE['session_key']))
        echo("<p>Sesja: ".$_COOKIE['session_key']."</p>");
    ?>
    </p>
  </body>
</html>