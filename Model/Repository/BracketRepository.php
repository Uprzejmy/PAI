<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatchReadOnly.php";

class BracketRepository
{
  public static function getBracketMatchesByTournamentId(mysqli $connection, $tournamentId)
  {
    $matches = array();

    $queryString = "SELECT matches.id as 'matchId', matches.match_order as 'matchOrder',
                           teams_matches.team_id
                    FROM teams_matches
                    LEFT JOIN matches ON teams_matches.match_id = matches.id
                    LEFT JOIN teams ON teams_matches.team_id = teams.id
                    WHERE matches.tournament_id = ?
                    GROUP BY matches.id
                    ORDER BY matches.match_date DESC";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();

    /*
    $result = $query->get_result();

    while($tournament = $result->fetch_object("Tournament"))
    {
      $tournaments[] = $tournament;
    }

    return $tournaments;
    */
  }

  public static function createMatch(mysqli $connection, $tournamentId, $order)
  {
    $queryString = "INSERT INTO matches (tournament_id, match_order) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$tournamentId, $order);
    $query->execute();

    return $query->insert_id;
  }

  public static function createTeamMatch(mysqli $connection, $matchId, $teamId)
  {
    $queryString = "INSERT INTO teams_matches (match_id, team_id) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$matchId, $teamId);
    $query->execute();

    return $query->insert_id;
  }
}