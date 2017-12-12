<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Front/User/UserSession.php";

class AuthenticationService
{
  public static function authenticate($cookie) : UserSession
  {
    if(isset($cookie['email']) && isset($cookie['session_key']) && isset($cookie['token']))
    {
      $session = UserSessionRepository::getSession($cookie['email'], $cookie['session_key'], $cookie['token']);

      if($session === null)
      {
        UserSessionRepository::deleteSession($cookie['session_key']);

        self::invalidateUserSessionAndDie();
      }

      self::reloadSessionToken($session);

      $session->setLogged(true);
      return $session;
    }

    return new UserSession();
  }

  private static function reloadSessionToken(UserSession $session)
  {
    $session->setToken(rand(0,1000));

    UserSessionRepository::updateToken($session->getId(), $session->getToken());

    setcookie("token", $session->getToken(), time()+3600, "/");
  }

  private static function invalidateUserSessionAndDie()
  {
    setcookie("token", null, time()-3600, "/");
    setcookie("email", null, time()-3600, "/");
    setcookie("session_key", null, time()-3600, "/");

    header("Location: /login", true, 301);
    die();
  }
}