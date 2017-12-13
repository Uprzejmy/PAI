<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/UserRepository.php";

class Model
{
  public function getAllUsers(mysqli $connection)
  {
    return UserRepository::getUsers($connection);
  }

  public function getUserById(mysqli $connection, $id)
  {
    return UserRepository::getUserById($connection, $id);
  }

  public function loginUser($email, $password)
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
  }
}