<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/UserSession.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/UserSessionRepository.php";

class AuthenticationService
{
  public static function authenticate($cookie) : UserSession
  {
    if(isset($cookie['email']) && isset($cookie['session_key']) && isset($cookie['token']))
    {
      try
      {
        $session = UserSessionRepository::getSession($cookie['email'], $cookie['session_key'], $cookie['token']);

        self::reloadSessionToken($session);

        $session->setLogged(true);

        return $session;
      }
      catch(TypeError $t)
      {
        UserSessionRepository::deleteSession($cookie['session_key']);

        self::invalidateUserSessionAndDie();
      }
    }

    return new UserSession();
  }

  public static function createSession($userId, $email)
  {
    $token = rand(0,1000);
    $sessionKeyString = $email.$token.time();
    $sessionKey = md5($sessionKeyString);

    UserSessionRepository::createSession($userId, $email, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $sessionKey, $token);

    setcookie("token", $token, time()+2*3600, "/");
    setcookie("email", $email, time()+2*3600, "/");
    setcookie("user_id", $userId, time()+2*3600, "/");
    setcookie("session_key", $sessionKey, time()+2*3600, "/");
  }

  public static function deleteSession($sessionKey)
  {
    UserSessionRepository::deleteSession($sessionKey);

    self::invalidateUserSession();
  }

  private static function reloadSessionToken(UserSession $session)
  {
    $session->setToken(rand(0,1000));

    UserSessionRepository::updateSessionToken($session->getSessionKey(), $session->getToken());

    setcookie("token", $session->getToken(), time()+2*3600, "/");
  }

  private static function invalidateUserSession()
  {
    setcookie("token", null, time()-3600, "/");
    setcookie("email", null, time()-3600, "/");
    setcookie("user_id", null, time()-3600, "/");
    setcookie("session_key", null, time()-3600, "/");
  }

  private static function invalidateUserSessionAndDie()
  {
    self::invalidateUserSession();

    header("Location: /homepage", true, 301);
    die();
  }
}