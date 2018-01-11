<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Utils.php";

class BracketMatchReadOnly
{
  public $matchId = "";
  public $leftTeamName = "";
  public $leftTeamScore = 0;
  public $leftTeamId;
  public $rightTeamName = "";
  public $rightTeamScore = 0;
  public $rightTeamId;
  public $matchOrder = "";
  public $matchDate = "";
  public $tournamentId;

  public function getPrintableMatchDate()
  {
    return Utils::getDateFromStringDatetime($this->matchDate);
  }
}