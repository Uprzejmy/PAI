<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/UserRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TeamRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/User.php";

class ExamplesModel
{
  public function loadExamples()
  {
    $connection = DbConnection::getInstance()->getConnection();

    $this->loadExampleUsersData($connection);
    $users = UserRepository::getAllUsers($connection);

    $this->loadExampleTeamsData($connection, $users);

    $this->loadExampleTournamentsData($connection, $users);
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
    $this->createTeam($connection, $users[array_rand($users)]->getId(), "Momma, dont let you babies grow up to be Cowboys");
  }

  private function createTeam(mysqli $connection, $userId, $name)
  {
    $teamId = TeamRepository::createTeam($connection, $userId, $name);
    echo var_dump($teamId, $userId) . "</br>";
    TeamRepository::addMemberToTeam($connection, $teamId, $userId);
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

}