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
  public $rightTeamName = "";
  public $rightTeamScore = 0;
  public $matchOrder = "";
  public $matchDate = "";

  public function getPrintableMatchDate()
  {
    return Utils::getDateFromStringDatetime($this->matchDate);
  }
}