<?php
/**
 * Created by Uprzejmy
 */

class AuthorizationService
{
  public static function isUserAuthorized(Route $route, UserSession $session) : bool
  {

    if(!$session->isUserLogged())
    {
        if($route->requiresLogged)
        {
          return false;
        }
    }

    return true;
  }
}