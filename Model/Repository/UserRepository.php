<?php
/**
 * Created by Uprzejmy
 */

class UserRepository
{
  public static function getUsers(mysqli $connection)
  {
    $queryString = "SELECT * from users";

    $query = $connection->prepare($queryString);
    $query->execute();

    $usersData = mysqli_fetch_assoc($query);

    var_dump($usersData);

    return $usersData;
  }

}