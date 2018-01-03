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

  /**
   * @param $userId
   * @return Team[]
   */
  public function getUserTeamInvitations($userId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $teamInvitations = TeamRepository::getTeamInvitationsByUserId($connection, $userId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $teamInvitations;
  }

  public function acceptTeamInvitation($teamId, $userId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    if(TeamRepository::isUserInvitationPending($connection, $teamId, $userId))
    {
      $connection->begin_transaction();

      TeamRepository::removeUserInvitation($connection, $teamId, $userId);
      TeamRepository::addMemberToTeam($connection, $teamId, $userId);


      if($connection->error)
      {
        $connection->rollback();
        return false;
      }

      $connection->commit();

    }
  }

  /**
   * @param $userId
   * @return Tournament[]
   */
  public function getUserTournaments($userId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $tournaments = TournamentRepository::getTournamentsByUserId($connection, $userId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $tournaments;
  }
}