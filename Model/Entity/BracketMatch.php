<?php
/**
 * Created by Uprzejmy
 */

class BracketMatch
{
  private $leftTeam;
  private $rightTeam;
  private $order;

  /**
   * @return mixed
   */
  public function getLeftTeam()
  {
    return $this->leftTeam;
  }

  /**
   * @param mixed $leftTeam
   */
  public function setLeftTeam($leftTeam)
  {
    $this->leftTeam = $leftTeam;
  }

  /**
   * @return mixed
   */
  public function getRightTeam()
  {
    return $this->rightTeam;
  }

  /**
   * @param mixed $rightTeam
   */
  public function setRightTeam($rightTeam)
  {
    $this->rightTeam = $rightTeam;
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
}