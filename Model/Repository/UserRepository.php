<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";

class UserRepository
{
  public static function getAllUsers(mysqli $connection)
  {
    $users = array();

    $queryString = "SELECT id, email FROM users";

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

  public static function getUserByEmail(mysqli $connection, $email) : User
  {
    $queryString = "SELECT id, email FROM users WHERE email = ?";

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

  public static function isEmailTaken(mysqli $connection, $email) : bool
  {
    $queryString = "SELECT 1 FROM users WHERE email = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("s",$email);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function createUser(mysqli $connection, $email, $hashedPassword) : int
  {
    $queryString = "INSERT INTO users (email, password) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("ss",$email, $hashedPassword);
    $query->execute();

    return $query->insert_id;
  }
}