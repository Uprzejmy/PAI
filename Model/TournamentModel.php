<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";

class TournamentModel
{
  public function createTournament($adminId, $name, $description="")
  {
    $connection = DbConnection::getInstance()->getConnection();

    if(TournamentRepository::isTournamentNameInUse($connection, $name))
    {
      return null;
    }

    $tournamentId = TournamentRepository::createTournament($connection, $adminId, $name, $description);

    return $tournamentId;
  }

  public function getTournamentById($id)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $tournament = TournamentRepository::getTournamentById($connection, $id);
    }
    catch(TypeError $t)
    {
      return null;
    }

    return $tournament;
  }

  /**
   * @param $tournamentId
   * @return Team[]
   */
  public function getTournamentTeams($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $teams = TeamRepository::getTeamsByTournamentId($connection, $tournamentId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $teams;
  }

  /**
   * @param $tournamentId
   * @param $userId
   * @return bool
   */
  public function isUserAdminInTournament($tournamentId, $userId) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    return TournamentRepository::isUserAdminInTournament($connection, $tournamentId, $userId);
  }

  public function removeTeamFromTournament($tournamentId, $teamId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    TournamentRepository::removeTeamFromTournament($connection, $tournamentId, $teamId);

    return;
  }
}