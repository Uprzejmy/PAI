<?php

class TeamMatch
{
  private $id;
  private $score;
  private $match;
  private $team;

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
  public function getScore()
  {
    return $this->score;
  }

  /**
   * @param mixed $score
   */
  public function setScore($score)
  {
    $this->score = $score;
  }

  /**
   * @return Match
   */
  public function getMatch() : Match
  {
    return $this->match;
  }

  /**
   * @param Match $match
   */
  public function setMatch(Match $match)
  {
    $this->match = $match;
  }

  /**
   * @return Team
   */
  public function getTeam() : Team
  {
    return $this->team;
  }

  /**
   * @param Team $team
   */
  public function setTeam(Team $team)
  {
    $this->team = $team;
  }


}