<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatchReadOnly.php";

class BracketRepository
{
  public static function getDetailedBracketMatchesByTournamentId(mysqli $connection, $tournamentId)
  {
    $bracketMatches = array();

    $queryString = "SELECT matches.id as 'matchId', matches.match_order as 'matchOrder', 
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
}