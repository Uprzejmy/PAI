<?php
/**
 * Created by Uprzejmy
 */

class Match
{
  private $id;
  private $matchDate;
  private $order;

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
   * @return mixed
   */
  public function getOrder()
  {
    return $this->order;
  }

  /**
   * @param mixed $order
   */
  public function setOrder($order)
  {
    $this->order = $order;
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