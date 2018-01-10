<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/BracketRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/BracketHelper.php";

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

  public function startTournament($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    if($this->canTournamentBeStarted($tournamentId))
    {
      $teams = $this->getTournamentTeams($tournamentId);
      $bracketMatches = BracketHelper::generateBracket($teams);

      $connection->begin_transaction();

      foreach($bracketMatches as $bracketMatch)
      {
        $matchId = BracketRepository::createMatch($connection, $tournamentId, $bracketMatch->getOrder());
        BracketRepository::createTeamMatch($connection, $matchId, $bracketMatch->getLeftTeam()->getId(), 0);

        //TODO improve this empty data handling
        if($bracketMatch->getRightTeam() !== null)
        {
          BracketRepository::createTeamMatch($connection, $matchId, $bracketMatch->getRightTeam()->getId(), 1);
        }
      }

      TournamentRepository::setTournamentStarted($connection, $tournamentId);

      if($connection->error)
      {
        $connection->rollback();
        return;
      }

      $connection->commit();
    }
  }

  public function canTournamentBeStarted($tournamentId) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    if(TournamentRepository::isTournamentStarted($connection, $tournamentId))
    {
      return false;
    }

    $teams = $this->getTournamentTeams($tournamentId);
    if(count($teams) < 1)
    {
      return false;
    }

    return true;
  }

  public function getDetailedBracketMatches($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $bracketMatchesRO = BracketRepository::getDetailedBracketMatchesByTournamentId($connection, $tournamentId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $bracketMatchesRO;
  }

  public function getDetailedAndPlayedBracketMatches($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $bracketMatchesRO = BracketRepository::getDetailedAndPlayedBracketMatchesByTournamentId($connection, $tournamentId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $bracketMatchesRO;
  }

  public function getBracketHtmlRepresentation($tournamentId)
  {
    $bracketMatches = $this->getDetailedBracketMatches($tournamentId);

    if($bracketMatches !== null)
    {
      foreach($bracketMatches as $bracketMatch)
      {
        if($bracketMatch->leftTeamName === null || $bracketMatch->leftTeamScore === null)
        {
          $bracketMatch->leftTeamName = "";
          $bracketMatch->leftTeamScore = 0;
        }

        if($bracketMatch->rightTeamName === null || $bracketMatch->rightTeamScore === null)
        {
          $bracketMatch->rightTeamName = "";
          $bracketMatch->rightTeamScore = 0;
        }
      }

      return BracketHelper::generateBracketHtmlView($bracketMatches);
    }

    return "";
  }
}