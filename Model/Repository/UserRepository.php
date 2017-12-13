<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";

class UserRepository
{
  public static function getUsers(mysqli $connection)
  {
    $users = array();

    $queryString = "SELECT id, email, name, surname, password, registered_at FROM users";

    $query = $connection->prepare($queryString);
    $query->execute();

    $result = $query->get_result();

    while($user = $result->fetch_object("User"))
    {
      $users[] = $user;
    }

    return $users;
  }

  public static function getUserById(mysqli $connection, $id) : User
  {
    $queryString = "SELECT id, email, name, surname, password, registered_at FROM users WHERE id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("i",$id);
    $query->execute();

    $result = $query->get_result();

    if ($user = $result->fetch_object("User"))
    {
      /** @var User $user */
      return $user;
    }

    return null;
  }

  public static function getUserWithPasswordByEmail(mysqli $connection, $email) : User
  {
    $queryString = "SELECT id, email, password FROM users WHERE email = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("s",$email);
    $query->execute();

    $result = $query->get_result();

    if ($user = $result->fetch_object("User"))
    {
      /** @var User $user */
      return $user;
    }

    return null;
  }
}