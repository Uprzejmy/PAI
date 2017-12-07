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
}