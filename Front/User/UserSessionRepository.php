<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/UserSession.php";

class UserSessionRepository
{
  public static function getSession($email, $sessionKey, $token) : UserSession
  {
    $connection = DbConnection::getInstance()->getConnection();

    $queryString = "SELECT user_id, email, session_key, token FROM sessions WHERE email = ? AND session_key = ? AND token = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ssi", $email, $sessionKey, $token);

    $query->execute();

    $result = $query->get_result();

    if ($session = $result->fetch_object("UserSession"))
    {
      /** @var UserSession $session */
      return $session;
    }

    return null;
  }

  public static function createSession($userId, $email, $ip, $agent, $sessionKey, $token)
  {
    $connection = DbConnection::getInstance()->getConnection();

    $queryString = "INSERT INTO sessions(user_id, email, ip, agent, session_key, token) VALUES (?, ?, ?, ?, ?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("issssi", $userId, $email, $ip, $agent, $sessionKey, $token);

    $query->execute();
  }

  public static function deleteSession($sessionKey)
  {
    $connection = DbConnection::getInstance()->getConnection();

    $queryString = "DELETE FROM sessions WHERE session_key = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("s", $sessionKey);

    $query->execute();
  }

  public static function updateSessionToken($sessionKey, $token)
  {
    $connection = DbConnection::getInstance()->getConnection();

    $queryString = "UPDATE sessions SET token=? WHERE session_key=?";

    $query = $connection->prepare($queryString);
    $query->bind_param("is", $token, $sessionKey);

    $query->execute();
  }

}