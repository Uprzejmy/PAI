<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatch.php";

class BracketHelper
{
  /**
   * @param Team[] $teams
   * @return mixed
   *
   * this function should take collection of teams and return html view of the tournament bracket
   * order of array elements matter,
   *
   * TODO this shouldn't take teams as the input. Tournament should've already been deployed at this point
   */
  public static function generateBracketHtmlView($teams)
  {
    //TODO implement

    return null;
  }

  /**
   * @param Team[] $teams
   * @return BracketMatch[]
   *
   * this function should take the collection of teams, and deploy them at random order into pairs
   * important part of the bracket structure is that the size of certain round is always a power of 2
   * some teams may have been assigned an empty opponent
   *
   * return array of the following structures:
   *
   * int order
   * Team leftTeam
   * Team rightTeam
   *
   */
  public static function generateBracket($teams)
  {
    $numberOfTeams = count($teams);
    $teamsArrayKeys = array_keys($teams);
    $randomTeamKeyGenerator = new randomElementGetter($teamsArrayKeys);

    //2->1, [3-4]->2, [5-8]->3, [9-16]->4, ...
    $numberOfRounds = ceil(log($numberOfTeams, 2));

    echo "number of rounds: $numberOfRounds</br>";

    //number of matches in first round!
    $numberOfMatches = pow(2, $numberOfRounds)/2;

    echo "number of matches in first round: $numberOfMatches</br>";

    //generate the matches and assign the left team
    $bracketMatches = array();
    foreach(range($numberOfMatches, 2*$numberOfMatches-1) as $order)
    {
      $bracketMatch = new BracketMatch();
      $bracketMatch->setOrder($order);
      $bracketMatch->setLeftTeam($teams[$randomTeamKeyGenerator->getNext()]);

      $bracketMatches[$order] = $bracketMatch;
    }

    //try to assign the right team (if there's any left of them)
    foreach($bracketMatches as $bracketMatch)
    {
      $index = $randomTeamKeyGenerator->getNext();

      if($index !== null)
      {
        $bracketMatch->setRightTeam($teams[$index]);
      }
    }

    echo "</br></br>";
    echo "bracketMatches:</br>";
    echo "<pre>";
    foreach($bracketMatches as $match)
    {
      echo "order: ".$match->getOrder()."</br>";
      echo "left: ".$match->getLeftTeam()->getName()."</br>";
      if($match->getRightTeam() !== null)
      {
        echo "right: ".$match->getRightTeam()->getName()."</br>";
      }
      echo "</br></br>";
    }
    echo "</pre>";

    return $bracketMatches;
  }

}

class randomElementGetter
{
  private $elements;
  private $index;
  private $maxIndex;

  public function __construct($elements)
  {
    $this->index = 0;
    $this->maxIndex = count($elements);
    $this->elements = $elements;
    shuffle($this->elements);
  }

  public function getNext()
  {
    if($this->index < $this->maxIndex)
    {
      return $this->elements[$this->index++];
    }

    return null;
  }
}