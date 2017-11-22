<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
?>

<?php
  if(isset($_COOKIE['email']) && isset($_COOKIE['session_key']) && isset($_COOKIE['token']))
  {
    require($_SERVER["DOCUMENT_ROOT"]."/env.php");
    include($ROOT."/connect.php");

    $query = $mysqli->prepare("SELECT id, token FROM sessions WHERE session_key=?");

    $query->bind_param('s', $_COOKIE['session_key']);
    $query->execute();

    $result = $query->get_result();
    $session = $result->fetch_assoc();

    if($_COOKIE['token'] != $session['token'])
    {
      echo("<p>Błąd sesji, zaloguj się ponownie</p>");
      $query = $mysqli->prepare("DELETE FROM sessions WHERE id=?");

      $query->bind_param('d', $session['id']);
      $query->execute();

      setcookie("token", null, time()-3600, "/");
      setcookie("email", null, time()-3600, "/");
      setcookie("session_key", null, time()-3600, "/");

      header('Location: ' . '/homepage');
      die();
    }

    $token = rand(0,1000);

    $query = $mysqli->prepare("UPDATE sessions SET token=? WHERE id=?");

    $query->bind_param('sd', $token, $session['id']);
    $query->execute();

    setcookie("token", $token, time()+3600, "/");

    echo($token."</br>");
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
    <a href="/tournamentShow">Tournament</a>

    <div class="example">
    <?php
      if(isset($_COOKIE['email']))
        echo("<p>Zalogowano jako: ".$_COOKIE['email']."</p>");
      else
        echo("<p>niezalogowano</p>");
      //if(isset($_COOKIE['session_key']))
      //  echo("<p>Sesja: ".$_COOKIE['session_key']."</p>");
    ?>
    </div>
  </body>
</html>