<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DbConnection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Repository/TournamentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/Tournament.php";

class TournamentModel
{
  public function createTournament($adminId, $name, $description="")
  {
    $connection = DbConnection::getInstance()->getConnection();

    if(TournamentRepository::isTournamentNameInUse($connection, $name))
    {
      return null;
    }

    $tournamentId = TournamentRepository::createTournament($connection, $adminId, $name, $description);

    return $tournamentId;
  }
}