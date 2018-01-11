<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatchReadOnly.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Match.php";

class BracketRepository
{
  public static function getDetailedBracketMatchesByTournamentId(mysqli $connection, $tournamentId)
  {
    $bracketMatches = array();

    $queryString = "SELECT matches.id as 'matchId', matches.match_order as 'matchOrder', match_date as 'matchDate',
                           tleft.name as 'leftTeamName', tmleft.scores as 'leftTeamScore', 
                           tright.name as 'rightTeamName', tmright.scores as 'rightTeamScore'
                    FROM matches
                    LEFT JOIN teams_matches tmleft ON matches.id = tmleft.match_id AND tmleft.position = 0
                    LEFT JOIN teams tleft ON tmleft.team_id = tleft.id
                    LEFT JOIN teams_matches tmright ON matches.id = tmright.match_id AND tmright.position = 1
                    LEFT JOIN teams tright ON tmright.team_id = tright.id
                    WHERE matches.tournament_id = ?
                    ORDER BY matchOrder DESC";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();


    $result = $query->get_result();

    while($bracketMatch = $result->fetch_object("BracketMatchReadOnly"))
    {
      $bracketMatches[$bracketMatch->matchOrder] = $bracketMatch;
    }

    return $bracketMatches;
  }

  public static function getDetailedAndPlayedBracketMatchesByTournamentId(mysqli $connection, $tournamentId)
  {
    $bracketMatches = array();

    $queryString = "SELECT matches.id as 'matchId', matches.match_order as 'matchOrder', matches.match_date as 'matchDate', 
                           tleft.name as 'leftTeamName', tmleft.scores as 'leftTeamScore', 
                           tright.name as 'rightTeamName', tmright.scores as 'rightTeamScore'
                    FROM matches
                    LEFT JOIN teams_matches tmleft ON matches.id = tmleft.match_id AND tmleft.position = 0
                    LEFT JOIN teams tleft ON tmleft.team_id = tleft.id
                    LEFT JOIN teams_matches tmright ON matches.id = tmright.match_id AND tmright.position = 1
                    LEFT JOIN teams tright ON tmright.team_id = tright.id
                    WHERE 
                      matches.tournament_id = ? AND 
                      matches.match_date IS NOT NULL AND 
                      tmleft.id IS NOT NULL AND
                      tmright.id IS NOT NULL
                    ORDER BY matchDate DESC";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();


    $result = $query->get_result();

    while($bracketMatch = $result->fetch_object("BracketMatchReadOnly"))
    {
      $bracketMatches[$bracketMatch->matchOrder] = $bracketMatch;
    }

    return $bracketMatches;
  }

  public static function getDetailedBracketMatchesAwaitingForScore(mysqli $connection, $tournamentId)
  {
    $bracketMatches = array();

    $queryString = "SELECT matches.id as 'matchId', matches.match_order as 'matchOrder', 
                           tleft.name as 'leftTeamName', tleft.id as 'leftTeamId',
                           tright.name as 'rightTeamName', tright.id as 'rightTeamId'
                    FROM matches
                    LEFT JOIN teams_matches tmleft ON matches.id = tmleft.match_id AND tmleft.position = 0
                    LEFT JOIN teams tleft ON tmleft.team_id = tleft.id
                    LEFT JOIN teams_matches tmright ON matches.id = tmright.match_id AND tmright.position = 1
                    LEFT JOIN teams tright ON tmright.team_id = tright.id
                    WHERE 
                      matches.tournament_id = ? AND 
                      matches.match_date IS NULL AND 
                      tmleft.id IS NOT NULL AND
                      tmright.id IS NOT NULL";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();


    $result = $query->get_result();

    while($bracketMatch = $result->fetch_object("BracketMatchReadOnly"))
    {
      $bracketMatches[$bracketMatch->matchOrder] = $bracketMatch;
    }

    return $bracketMatches;
  }

  public static function createMatch(mysqli $connection, $tournamentId, $order)
  {
    $queryString = "INSERT INTO matches (tournament_id, match_order) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$tournamentId, $order);
    $query->execute();

    return $query->insert_id;
  }

  public static function createTeamMatch(mysqli $connection, $matchId, $teamId, $position)
  {
    $queryString = "INSERT INTO teams_matches (match_id, team_id, position) VALUES (?, ?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("iii",$matchId, $teamId, $position);
    $query->execute();

    return $query->insert_id;
  }

  public static function getDetailedBracketMatchById(mysqli $connection, $matchId)
  {
    $queryString = "SELECT matches.id as 'matchId', matches.tournament_id as 'tournamentId', matches.match_order as 'matchOrder', 
                           tleft.id as 'leftTeamId', 
                           tright.id as 'rightTeamId'
                    FROM matches
                    LEFT JOIN teams_matches tmleft ON matches.id = tmleft.match_id AND tmleft.position = 0
                    LEFT JOIN teams tleft ON tmleft.team_id = tleft.id
                    LEFT JOIN teams_matches tmright ON matches.id = tmright.match_id AND tmright.position = 1
                    LEFT JOIN teams tright ON tmright.team_id = tright.id
                    WHERE matches.id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $matchId);
    $query->execute();

    $result = $query->get_result();

    $match = $result->fetch_object("BracketMatchReadOnly");

    return $match;
  }

  public static function updateMatchDate(mysqli $connection, $matchId)
  {
    $queryString = "UPDATE matches SET match_date = NOW() WHERE matches.id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $matchId);

    $query->execute();
  }

  public static function updateTeamMatchScore($connection, $matchId, $score, $position)
  {
    $queryString = "UPDATE teams_matches SET teams_matches.scores = ? WHERE teams_matches.match_id = ? AND teams_matches.position = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("iii", $score, $matchId, $position);

    $query->execute();
  }

  public static function getMatchIdByOrder($connection, $tournamentId, $matchOrder)
  {
    $queryString = "SELECT matches.id FROM matches WHERE matches.tournament_id = ? AND matches.match_order = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $tournamentId, $matchOrder);
    $query->execute();


    $result = $query->get_result();

    $match = $result->fetch_object("Match");

    return $match;
  }
}