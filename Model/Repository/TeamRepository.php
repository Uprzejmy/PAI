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

    if($query->error)
    {
      var_dump($query->error);
    }

    return $query->insert_id;
  }

  public static function addMemberToTeam(mysqli $connection, $teamId, $userId) : int
  {
    $queryString = "INSERT INTO teams_members (team_id, user_id) VALUES (?, ?)";
    $query = $connection->prepare($queryString);
    $query->bind_param("is",$teamId, $userId);
    $query->execute();

    if($query->error)
    {
      var_dump($query->error);
    }

    return $query->insert_id;
  }

  public static function getTeamsByUserId(mysqli $connection, $userId)
  {
    $teams = array();

    $queryString = "SELECT count(teams_members.id) as number_of_members, teams.id, teams.name FROM teams 
                    LEFT JOIN teams_members ON teams.id = teams_members.team_id 
                    WHERE user_id = ? 
                    GROUP BY teams.id";
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