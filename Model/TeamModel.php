<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TeamRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";

class TeamModel
{
  /**
   * @param $teamId
   * @return Tournament[]
   */
  public function getTeamTournaments($teamId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $tournaments = TournamentRepository::getTournamentsByTeamId($connection, $teamId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $tournaments;
  }

  /**
   * @param $teamId
   * @return User[]
   */
  public function getTeamMembers($teamId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $users = TeamRepository::getTeamMembers($connection, $teamId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $users;
  }

  /**
   * @param $teamId
   * @param $userId
   * @return bool
   */
  public function isUserInTeam($teamId, $userId) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    return TeamRepository::isUserInTeam($connection, $teamId, $userId);
  }

  /**
   * @param $teamId
   * @param $userId
   * @return bool
   */
  public function isUserAdminInTeam($teamId, $userId) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    return TeamRepository::isUserAdminInTeam($connection, $teamId, $userId);
  }

  /**
   * @param $teamId
   * @param $userId
   */
  public function removeMemberFromTeam($teamId, $userId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    TeamRepository::removeMemberFromTeam($connection, $teamId, $userId);

    return;
  }

  public function sendInvitationToUser($teamId, $email)
  {
    $connection = DbConnection::getInstance()->getConnection();

    $user = UserRepository::getUserByEmail($connection, $email);

    if($user === null)
    {
      return;
    }

    if(!TeamRepository::isUserInvitationPending($connection, $teamId, $user->getId()))
    {
      TeamRepository::createUserInvitation($connection, $teamId, $user->getId());
    }

    return;
  }
}