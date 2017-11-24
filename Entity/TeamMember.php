<?php

class TeamMember
{
  private $id;
  private $joinedAt;
  private $user;
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
   * @return User
   */
  public function getUser() : User
  {
    return $this->user;
  }

  /**
   * @param User $user
   */
  public function setUser(User $user)
  {
    $this->user = $user;
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