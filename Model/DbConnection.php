<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/parameters.php";

class DbConnection
{
  private static $instance;
  private $connection;

  public static function getInstance()
  {
    if(self::$instance === null)
    {
      self::$instance = new DbConnection();
    }

    return self::$instance;
  }

  private function __construct()
  {
    $this->connect();
  }

  private function connect()
  {
    //TODO refactor this, don't put connection information in the global scope
    $this->connection = new mysqli($GLOBALS['dbHost'], $GLOBALS['dbUser'], $GLOBALS['dbPassword'], $GLOBALS['dbName']);

  }

  public function getConnection() : mysqli
  {
    return $this->connection;
  }

}