<?php

  function validateUser($mysqli, $email, $sessionKey, $token, &$userId)
  {
    if($email !== null && $sessionKey !== null && $token !== null)
    {
      $query = $mysqli->prepare("SELECT sessions.id as sessionId, sessions.token as sessionToken, users.id as userId FROM sessions, users WHERE sessions.user_id=users.id AND users.email=? AND sessions.session_key=? AND sessions.token=?");

      $query->bind_param('sss', $email, $sessionKey, $token);
      $query->execute();

      $result = $query->get_result();
      $session = $result->fetch_assoc();

      if(!$session)
      {
        $query = $mysqli->prepare("DELETE FROM sessions WHERE session_key=?");

        $query->bind_param('s', $sessionKey);
        $query->execute();

        unvalidateUser("Session error, please log in again");
      }

      $userId = $session['userId'];

      reloadSessionToken($mysqli, $session['sessionId']);
    }
    else //if user is not logged in
    {
      unvalidateUser("You need to log in to access this page");
    }

  }

  function unvalidateUser($message="Something went wrong please log in again")
  {
    setcookie("token", null, time()-3600, "/");
    setcookie("email", null, time()-3600, "/");
    setcookie("session_key", null, time()-3600, "/");

    setcookie("logout_message", $message, time()+3600, "/");
    header('Location: ' . '/login');
    die();
  }

  function reloadSessionToken($mysqli, $sessionId)
  {
    $token = rand(0,1000);

    $query = $mysqli->prepare("UPDATE sessions SET token=? WHERE id=?");

    $query->bind_param('sd', $token, $sessionId);
    $query->execute();

    setcookie("token", $token, time()+3600, "/");
  }

?>