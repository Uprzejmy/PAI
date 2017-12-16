<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/UserRepository.php";

class ExamplesModel
{
  public function loadExamples()
  {
    $connection = DbConnection::getInstance()->getConnection();

    $this->loadExampleUsersData($connection);
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

}