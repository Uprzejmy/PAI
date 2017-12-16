<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TeamRepository.php";

class AccountModel
{
  /**
   * @param $userId
   * @return Team[]
   */
  public function getUserTeams($userId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $teams = TeamRepository::getTeamsByUserId($connection, $userId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $teams;
  }
}