<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";

class TournamentRepository
{
  public static function createTournament(mysqli $connection, $adminUserId, $name, $description) : int
  {
    $queryString = "INSERT INTO tournaments (admin_id, name, description) VALUES (?, ?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("iss",$adminUserId, $name, $description);
    $query->execute();

    return $query->insert_id;
  }

  public static function getTournamentById(mysqli $connection, $id)
  {
    $queryString = "SELECT tournaments.id, tournaments.name, tournaments.description, tournaments.started, tournaments.admin_id, tournaments.created_at FROM tournaments 
                    WHERE tournaments.id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $id);
    $query->execute();

    $result = $query->get_result();

    return $result->fetch_object("Tournament");
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

    $queryString = "SELECT DISTINCT tournaments.id, tournaments.name FROM tournaments 
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

  public static function isTournamentNameInUse(mysqli $connection, $name) : bool
  {
    $queryString = "SELECT 1 FROM tournaments WHERE name = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("s", $name);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function isUserAdminInTournament(mysqli $connection, $tournamentId, $userId) : bool
  {
    $queryString = "SELECT 1 FROM tournaments WHERE tournaments.id = ? AND tournaments.admin_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $tournamentId, $userId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function isUserInTournament(mysqli $connection, $tournamentId, $userId) : bool
  {
    $queryString = "SELECT 1 FROM tournaments
                    LEFT JOIN teams_tournaments ON tournaments.id = teams_tournaments.tournament_id
                    LEFT JOIN teams_members ON teams_tournaments.team_id = teams_members.team_id
                    WHERE tournaments.id = ? AND teams_members.user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $tournamentId, $userId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function removeTeamFromTournament(mysqli $connection, $tournamentId, $teamId)
  {
    $queryString = "DELETE FROM teams_tournaments WHERE teams_tournaments.tournament_id = ? AND teams_tournaments.team_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $tournamentId, $teamId);
    $query->execute();
  }

  public static function setTournamentStarted(mysqli $connection, $tournamentId)
  {
    $queryString = "UPDATE tournaments SET started = 1 WHERE tournaments.id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("i",$tournamentId);
    $query->execute();
  }

  public static function isTournamentStarted(mysqli $connection, $tournamentId) : bool
  {
    $queryString = "SELECT 1 FROM tournaments WHERE tournaments.id = ? AND tournaments.started = 1";

    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function getLastTenActiveTournaments(mysqli $connection)
  {
    $tournaments = array();

    $queryString = "SELECT DISTINCT tournaments.id, tournaments.name, tournaments.created_at, matches.match_date FROM tournaments 
                    LEFT JOIN matches ON tournaments.id = matches.tournament_id
                    ORDER BY matches.match_date DESC 
                    LIMIT 10";

    $query = $connection->prepare($queryString);
    $query->execute();

    $result = $query->get_result();

    while($tournament = $result->fetch_object("Tournament"))
    {
      $tournaments[] = $tournament;
    }

    return $tournaments;
  }

}