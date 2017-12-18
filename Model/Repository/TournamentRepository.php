<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";

class TournamentRepository
{
  public static function createTournament(mysqli $connection, $adminUserId, $name, $description = "") : int
  {
    $queryString = "INSERT INTO tournaments (admin_id, name, description) VALUES (?, ?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("iss",$adminUserId, $name, $description);
    $query->execute();

    return $query->insert_id;
  }

  public static function getAllTournaments(mysqli $connection)
  {
    $tournaments = array();

    $queryString = "SELECT id, name FROM tournaments";

    $query = $connection->prepare($queryString);
    $query->execute();

    $result = $query->get_result();

    while($tournament = $result->fetch_object("Tournament"))
    {
      $tournaments[] = $tournament;
    }

    return $tournaments;
  }

  public static function getTournamentsByUserId(mysqli $connection, $userId)
  {
    $tournaments = array();

    $queryString = "SELECT tournaments.id, tournaments.name FROM tournaments 
                    LEFT JOIN teams_tournaments ON tournaments.id = teams_tournaments.tournament_id
                    LEFT JOIN teams_members ON teams_members.team_id = teams_tournaments.team_id
                    WHERE teams_members.user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $userId);
    $query->execute();

    $result = $query->get_result();

    while($tournament = $result->fetch_object("Tournament"))
    {
      $tournaments[] = $tournament;
    }

    return $tournaments;
  }

  public static function getTournamentsByTeamId(mysqli $connection, $teamId)
  {
    $tournaments = array();

    $queryString = "SELECT tournaments.id, tournaments.name, tournaments.created_at FROM tournaments 
                    LEFT JOIN teams_tournaments ON tournaments.id = teams_tournaments.tournament_id
                    WHERE teams_tournaments.team_id = ?
                    ORDER BY tournaments.created_at DESC";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $teamId);
    $query->execute();

    $result = $query->get_result();

    while($tournament = $result->fetch_object("Tournament"))
    {
      $tournaments[] = $tournament;
    }

    return $tournaments;
  }

  public static function addTeamToTournament(mysqli $connection, $tournamentId, $teamId) : int
  {
    $queryString = "INSERT INTO teams_tournaments (tournament_id, team_id) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$tournamentId, $teamId);
    $query->execute();

    return $query->insert_id;
  }

}