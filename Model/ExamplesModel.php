<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/UserRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TeamRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Team.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";

class ExamplesModel
{
  public function loadExamples()
  {
    $connection = DbConnection::getInstance()->getConnection();

    $this->loadExampleUsersData($connection);
    $users = UserRepository::getAllUsers($connection);

    $this->loadExampleTeamsData($connection, $users);
    $teams = TeamRepository::getAllTeams($connection);

    $this->loadExampleTeamMembersData($connection, $teams, $users);

    $this->loadExampleTournamentsData($connection, $users);
    $tournaments = TournamentRepository::getAllTournaments($connection);

    $this->loadExampleTeamsTournamentsData($connection, $tournaments, $teams);
  }

  private function loadExampleUsersData(mysqli $connection)
  {
    /** admin data */
    UserRepository::createUser($connection, "admin@admin.com", password_hash("admin", PASSWORD_BCRYPT));

    /** test user data */
    UserRepository::createUser($connection, "test@test.test", password_hash("test", PASSWORD_BCRYPT));

    /** Users data */
    UserRepository::createUser($connection, "jerzy@kiler.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "ewa@szanska.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "jerzy@ryba.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "ryszarda@siarzewska.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "stefan@siarzewski.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "ferdynand@lipski.com", password_hash("test", PASSWORD_BCRYPT));
    UserRepository::createUser($connection, "mieczyslaw@klonisz.com", password_hash("test", PASSWORD_BCRYPT));
  }

  /**
   * @param mysqli $connection
   * @param User[] $users
   */
  private function loadExampleTeamsData(mysqli $connection, $users)
  {
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "A Dingo ate my Brady");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "A Rivers Run Suh It");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Aaron it Out");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Bottom of the Depth Chart");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Bridge over Troubled Waters");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Demaryius Targaryen");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Dont Pull a Hammy Watkins!");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Every Kiss Begins with Clay");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Flaccoroni and Cheese");
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Momma, dont let you babies");
  }

  private function createTeam(mysqli $connection, $userId, $name)
  {
    $teamId = TeamRepository::createTeam($connection, $userId, $name);

    TeamRepository::addMemberToTeam($connection, $teamId, $userId);
  }

  /**
   * @param mysqli $connection
   * @param Team[] $teams
   * @param User[] $users
   */
  private function loadExampleTeamMembersData(mysqli $connection, $teams, $users)
  {
    //for each team
    foreach($teams as $team)
    {
      //pick 5 random users
      $userArrayKeys = array_rand($users, 5);

      //for each of picked users
      foreach($userArrayKeys as $key)
      {
        //assign the user to the team
        if(!TeamRepository::isUserInTeam($connection, $team->getId(), $users[$key]->getId()))
        {
          TeamRepository::addMemberToTeam($connection, $team->getId(), $users[$key]->getId());
        }
      }

      //change membership into invitation, fix do not remove admin
      if(!TeamRepository::isUserAdminInTeam($connection, $team->getId(), $users[$userArrayKeys[0]]->getId()))
      {
        TeamRepository::removeMemberFromTeam($connection, $team->getId(), $users[$userArrayKeys[0]]->getId());
        TeamRepository::createUserInvitation($connection, $team->getId(), $users[$userArrayKeys[0]]->getId());
      }
    }
  }

  private function loadExampleTournamentsData(mysqli $connection, $users)
  {
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Springtime Pitch 2016 Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Northeast Swing Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Sunshine Easter Laxhead Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Crabfeast Futebol Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "2nd Edition Crossroads Football Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "10th Annual Warm Laxhead Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Crabfest Hot Hot Ground and Pound Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "53rd Annual Labor Day Air Raid Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Warm Presents Under the Tree Slugger Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "West Fútbol Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Hot Roundball Elite Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Southern Father's Day Goal Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "All-Star Coast Pitch Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Seaside Black Diamond Goal Competition Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Surfing Cabin Fever Goal Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "Shore Friday the 13th Swing For The Fences Tournament", "Football");
    $this->createTournament($connection, $users[array_rand($users)]->getId(), "National Heatwave Flag Day Net Tournament", "Football");
  }

  private function createTournament(mysqli $connection, $userAdminId, $name, $description)
  {
    TournamentRepository::createTournament($connection, $userAdminId, $name, $description);
  }

  /**
   * @param mysqli $connection
   * @param Tournament[] $tournaments
   * @param Team[] $teams
   */
  private function loadExampleTeamsTournamentsData(mysqli $connection, $tournaments, $teams)
  {
    //for each tournament
    foreach($tournaments as $tournament)
    {
      //pick 5 random users
      $teamsArrayKeys = array_rand($teams, 5);

      //for each of picked users
      foreach($teamsArrayKeys as $key)
      {
        //assign the user to the team
        TournamentRepository::addTeamToTournament($connection, $tournament->getId(), $teams[$key]->getId());
      }
    }
  }
}