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
}