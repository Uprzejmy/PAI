<?php
/**
 * Created by Uprzejmy
 */

class Match
{
  private $id;
  private $matchDate;
  private $order;

  private $tournament_id;

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
   * @return mixed
   */
  public function getTournamentId()
  {
    return $this->tournament_id;
  }

  /**
   * @param $tournamentId
   */
  public function setTournamentId($tournamentId)
  {
    $this->tournament_id = $tournamentId;
  }

}