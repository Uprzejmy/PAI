<?php

class Match
{
  private $id;
  private $matchDate;
  private $tournament;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getMatchDate()
  {
    return $this->matchDate;
  }

  /**
   * @param mixed $matchDate
   */
  public function setMatchDate($matchDate)
  {
    $this->matchDate = $matchDate;
  }

  /**
   * @return Tournament
   */
  public function getTournament() : Tournament
  {
    return $this->tournament;
  }

  /**
   * @param Tournament $tournament
   */
  public function setTournament(Tournament $tournament)
  {
    $this->$tournament = $tournament;
  }

}