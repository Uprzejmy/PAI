<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/IForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Form.php";

class TournamentJoinForm extends Form implements IForm
{
  private $teamId;
  private $tournamentId;

  public function bindData()
  {
    $this->teamId = $this->bindProperty('teamId');
    $this->tournamentId = $this->bindProperty('tournamentId');
  }

  public function validateData()
  {
    $this->valid = true;
  }

  public function invalidateForm($message = "")
  {
    $this->errors[] = $message;
    $this->valid = false;
  }

  public function getTeamId()
  {
    return $this->teamId;
  }

  public function getTournamentId()
  {
    return $this->tournamentId;
  }
}