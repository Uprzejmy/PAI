<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Team.php";

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
}