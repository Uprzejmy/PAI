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
    $query->bind_param("is",$teamId, $userId);
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
}