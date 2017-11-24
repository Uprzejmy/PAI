<?php

class TeamTournament
{
  private $id;
  private $joinedAt;
  private $team;
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
  public function getJoinedAt()
  {
    return $this->joinedAt;
  }

  /**
   * @param mixed $joinedAt
   */
  public function setJoinedAt($joinedAt)
  {
    $this->joinedAt = $joinedAt;
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
    $this->tournament = $tournament;
  }


}