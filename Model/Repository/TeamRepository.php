<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Team.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";

class TeamRepository
{
  public static function getAllTeams(mysqli $connection)
  {
    $teams = array();

    $queryString = "SELECT id, name FROM teams";

    $query = $connection->prepare($queryString);
    $query->execute();

    $result = $query->get_result();

    while($team = $result->fetch_object("Team"))
    {
      $teams[] = $team;
    }

    return $teams;
  }

  public static function createTeam(mysqli $connection, $leaderId, $name) : int
  {
    $queryString = "INSERT INTO teams (leader_id, name) VALUES (?, ?)";

    $query = $connection->prepare($queryString);
    $query->bind_param("is",$leaderId, $name);
    $query->execute();

    return $query->insert_id;
  }

  public static function addMemberToTeam(mysqli $connection, $teamId, $userId) : int
  {
    $queryString = "INSERT INTO teams_members (team_id, user_id) VALUES (?, ?)";
    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$teamId, $userId);
    $query->execute();

    return $query->insert_id;
  }

  public static function getTeamsByUserId(mysqli $connection, $userId)
  {
    $teams = array();

    $queryString = "SELECT count(tm2.id) as number_of_members, teams.id, teams.name FROM teams 
                    LEFT JOIN teams_members tm1 ON teams.id = tm1.team_id
                    LEFT JOIN teams_members tm2 ON teams.id = tm2.team_id
                    WHERE tm1.user_id = ? 
                    GROUP BY tm2.team_id, teams.id";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $userId);
    $query->execute();

    $result = $query->get_result();

    while($team = $result->fetch_object("Team"))
    {
      $teams[] = $team;
    }

    return $teams;
  }

  public static function getTeamsByAdminId(mysqli $connection, $adminId)
  {
    $teams = array();

    $queryString = "SELECT teams.id, teams.name FROM teams
                    WHERE teams.leader_id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $adminId);
    $query->execute();

    $result = $query->get_result();

    while($team = $result->fetch_object("Team"))
    {
      $teams[] = $team;
    }

    return $teams;
  }

  public static function getTeamById(mysqli $connection, $teamId)
  {
    $queryString = "SELECT teams.id, teams.name, teams.created_at FROM teams
                    WHERE teams.id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $teamId);
    $query->execute();

    $result = $query->get_result();
    $team = $result->fetch_object("Team");

    return $team;
  }

  public static function getTeamMembers(mysqli $connection, $teamId)
  {
    $teams = array();

    $queryString = "SELECT users.id, users.email, teams_members.joined_at FROM teams_members
                    LEFT JOIN users ON teams_members.user_id = users.id
                    WHERE teams_members.team_id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $teamId);
    $query->execute();

    $result = $query->get_result();

    while($user = $result->fetch_object("User"))
    {
      $users[] = $user;
    }

    return $users;
  }

  public static function isUserInTeam(mysqli $connection, $teamId, $userId) : bool
  {
    $queryString = "SELECT 1 FROM teams_members WHERE team_id = ? AND user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $teamId, $userId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function isUserAdminInTeam(mysqli $connection, $teamId, $userId) : bool
  {
    $queryString = "SELECT 1 FROM teams WHERE teams.id = ? AND teams.leader_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $teamId, $userId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function removeMemberFromTeam(mysqli $connection, $teamId, $userId)
  {
    $queryString = "DELETE FROM teams_members WHERE teams_members.team_id = ? AND teams_members.user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $teamId, $userId);
    $query->execute();
  }

  public static function createUserInvitation(mysqli $connection, $teamId, $userId) : int
  {
    $queryString = "INSERT INTO teams_invites (team_id, user_id) VALUES (?, ?)";
    $query = $connection->prepare($queryString);
    $query->bind_param("ii",$teamId, $userId);
    $query->execute();

    return $query->insert_id;
  }

  public static function isUserInvitationPending(mysqli $connection, $teamId, $userId) : int
  {
    $queryString = "SELECT 1 FROM teams_invites WHERE teams_invites.team_id = ? AND teams_invites.user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $teamId, $userId);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
      return true;
    }

    return false;
  }

  public static function removeUserInvitation(mysqli $connection, $teamId, $userId)
  {
    $queryString = "DELETE FROM teams_invites WHERE teams_invites.team_id = ? AND teams_invites.user_id = ?";

    $query = $connection->prepare($queryString);
    $query->bind_param("ii", $teamId, $userId);
    $query->execute();
  }

  public static function getTeamInvitationsByUserId(mysqli $connection, $userId)
  {
    $teams = array();

    $queryString = "SELECT teams.id, teams.name FROM teams_invites 
                    LEFT JOIN teams ON teams_invites.team_id = teams.id
                    WHERE teams_invites.user_id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $userId);
    $query->execute();

    $result = $query->get_result();

    while($team = $result->fetch_object("Team"))
    {
      $teams[] = $team;
    }

    return $teams;
  }

  public static function getTeamInvitationsByTeamId(mysqli $connection, $teamId)
  {
    $users = array();

    $queryString = "SELECT users.email, users.id FROM teams_invites 
                    LEFT JOIN users ON teams_invites.user_id = users.id
                    WHERE teams_invites.team_id = ?";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $teamId);
    $query->execute();

    $result = $query->get_result();

    while($user = $result->fetch_object("User"))
    {
      $users[] = $user;
    }

    return $users;
  }

  public static function isTeamNameInUse(mysqli $connection, $name) : bool
  {
    $queryString = "SELECT 1 FROM teams WHERE name = ?";

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

  public static function getTeamsByTournamentId(mysqli $connection, $tournamentId)
  {
    $teams = array();

    $queryString = "SELECT teams.id, teams.name, teams_tournaments.joined_at FROM teams_tournaments
                    LEFT JOIN teams ON teams_tournaments.team_id = teams.id
                    WHERE teams_tournaments.tournament_id = ?
                    ORDER BY teams_tournaments.joined_at";
    $query = $connection->prepare($queryString);
    $query->bind_param("i", $tournamentId);
    $query->execute();

    $result = $query->get_result();

    while($team = $result->fetch_object("Team"))
    {
      $teams[] = $team;
    }

    return $teams;
  }
}