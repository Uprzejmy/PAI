<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/BracketRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Match.php";
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
        if($bracketMatch->getRightTeam() === null)
        {
          $this->reportScore($matchId, 0, -1);
        }
        else
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

  public function getDetailedBracketMatchesAwaitingForScore($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $bracketMatchesRO = BracketRepository::getDetailedBracketMatchesAwaitingForScore($connection, $tournamentId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $bracketMatchesRO;
  }

  public function getBracketHtmlRepresentation($tournamentId)
  {
    $tournament = $this->getTournamentById($tournamentId);

    $html = "";

    if (!$tournament->isStarted())
    {
      return "<div><p>This tournament hasn't been started yet</p></div>";
    }

    if ($tournament->isEnded())
    {
      $winner = $this->getTournamentWinner($tournamentId);
      $name = $winner->getName();
      $html .= "<div><h2 class='tournament_winner'>1st place: $name</h2></div>";
    }

    $bracketMatches = $this->getDetailedBracketMatches($tournamentId);

    if($bracketMatches !== null)
    {
      foreach($bracketMatches as $bracketMatch)
      {
        if($bracketMatch->leftTeamName === null || $bracketMatch->rightTeamName === null || $bracketMatch->matchDate === null)
        {
          $bracketMatch->leftTeamScore = "-";
          $bracketMatch->rightTeamScore = "-";
        }
      }

      return $html . BracketHelper::generateBracketHtmlView($bracketMatches);;
    }

    return "";
  }

  public function isUserInTournament($tournamentId, $userId) : bool
  {
    $connection = DbConnection::getInstance()->getConnection();

    return TournamentRepository::isUserInTournament($connection, $tournamentId, $userId);
  }

  public function addTeamToTournament($tournamentId, $teamId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    TournamentRepository::addTeamToTournament($connection, $tournamentId, $teamId);
  }

  public function getLastTenActiveTournaments()
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $tournaments = TournamentRepository::getLastTenActiveTournaments($connection);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $tournaments;
  }

  public function reportScore($matchId, $leftScore, $rightScore)
  {
    if($leftScore === $rightScore)
    {
      return;
    }

    $connection = DbConnection::getInstance()->getConnection();

    $match = BracketRepository::getDetailedBracketMatchById($connection, $matchId);
    $newOrder = floor($match->matchOrder/2);
    $newPosition = 1 - $match->matchOrder % 2;
    $winnerId = $leftScore > $rightScore ? $match->leftTeamId : $match->rightTeamId;

    $connection->begin_transaction();

    BracketRepository::updateMatchDate($connection, $matchId);

    BracketRepository::updateTeamMatchScore($connection, $matchId, $leftScore, 0);
    BracketRepository::updateTeamMatchScore($connection, $matchId, $rightScore, 1);

    //this was the last tournament match
    if($newOrder < 1)
    {
      TournamentRepository::endTournament($connection, $match->tournamentId, $winnerId);
    }
    else
    {
      $newMatch = BracketRepository::getMatchIdByOrder($connection, $match->tournamentId, $newOrder);
      if($newMatch === null)
      {
        $newMatchId = BracketRepository::createMatch($connection, $match->tournamentId, $newOrder);
      }
      else
      {
        $newMatchId = $newMatch->getId();
      }

      BracketRepository::createTeamMatch($connection, $newMatchId, $winnerId, $newPosition);
    }


    if($connection->error)
    {
      $connection->rollback();
      return;
    }

    $connection->commit();
  }

  public function getTournamentWinner($tournamentId)
  {
    $connection = DbConnection::getInstance()->getConnection();

    try
    {
      $team = TournamentRepository::getTournamentWinner($connection, $tournamentId);
    }
    catch(TypeError $t)
    {
      return array();
    }

    return $team;
  }
}