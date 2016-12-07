<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");

  echo("logout");

  if(!isset($_COOKIE['email']))
  {
    header('Location: ' . '/login');
  }

  if(!isset($_COOKIE['session_key']))
  {
    header('Location: ' . '/login');
  }

  if(isset($_COOKIE['email']))
  {
    require($_SERVER["DOCUMENT_ROOT"]."/env.php");
    include($root."/connect.php");

    $query = $mysqli->prepare("delete from sessions WHERE session_key=?;");

    $query->bind_param('s', $_COOKIE['session_key']);
    $query->execute();

    setcookie("email", "", time()-3600, "/");
    setcookie("session_key", "", time()-3600, "/");
    setcookie("token", "", time()-3600, "/");
    header('Location: ' . '/homepage');
  }

?>