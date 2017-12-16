<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/UserRepository.php";

class UserModel
{
  public function loginUser($email, $password) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $user = UserRepository::getUserWithPasswordByEmail($connection, $email);

      if(password_verify($password, $user->getPassword()))
      {
        AuthenticationService::createSession($user->getId(), $user->getEmail());

        return true;
      }
    }
    catch(TypeError $t)
    {
      return false;
    }

    return false;
  }

  public function registerUser($email, $password, &$message) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    if (UserRepository::isEmailTaken($connection, $email))
    {
      $message = "Email already in use";
      return false;
    }

    $userId = UserRepository::createUser($connection, $email, password_hash($password, PASSWORD_BCRYPT));

    AuthenticationService::createSession($userId, $email);

    return true;
  }

  public function logoutUser($sessionKey)
  {
    AuthenticationService::deleteSession($sessionKey);
  }
}