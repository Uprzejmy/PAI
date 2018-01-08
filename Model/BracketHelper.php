<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatch.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/Entity/BracketMatchReadOnly.php";

class BracketHelper
{
  /**
   * @param BracketMatchReadOnly[] $bracketMatchesRO
   * @return mixed
   *
   * this function assumes that BracketMatchReadOnly[] has keys equal to particular BracketMatch element
   *
   * TODO this shouldn't take teams as the input. Tournament should've already been deployed at this point
   */
  public static function generateBracketHtmlView($bracketMatchesRO)
  {
    /*
    echo "<pre>";
    print_r($bracketMatchesRO);
    echo "</pre>";
    */

    $html = "";
    $html .= "<main class='tournament_bracket'>";

    //guaranteed by arguments assumptions
    $numberOfMatches = max(array_keys($bracketMatchesRO));

    //1->1, 3->2, 7->3, 15->4, ...
    $numberOfRounds = log($numberOfMatches+1,2);

    $lastPrintedMatchKey = $numberOfMatches;
    $numberOfMatchesInRound = $numberOfMatches+1;

    //for each round
    for($i=1;$i<=$numberOfRounds;$i++)
    {
      $html .= "<ul class='round'>";

      $html .= "<li class='spacer'>&nbsp;</li>";

      //for each match in round
      $numberOfMatchesInRound = $numberOfMatchesInRound/2;
      for($j=0;$j<$numberOfMatchesInRound;$j++)
      {
        $match = self::getBracketMatchByIndex($bracketMatchesRO, $lastPrintedMatchKey--);

        $html .= "<li class='game game-top'>$match->leftTeamName<span>$match->leftTeamScore</span></li>";
        //$html .= "<li class='game game-spacer'>&nbsp;</li>";
        $html .= "<li class='game game-bottom'>$match->rightTeamName<span>$match->rightTeamScore</span></li>";

        $html .= "<li class='spacer'>&nbsp;</li>";
      }

      $html .= "</ul>";
    }

    $html .= "</main>";

    return $html;
  }

  private static function getBracketMatchByIndex($bracketMatches, $index)
  {
    if(key_exists($index, $bracketMatches))
    {
      return $bracketMatches[$index];
    }

    return new BracketMatchReadOnly();
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

    //number of matches in first round!
    $numberOfMatches = pow(2, $numberOfRounds)/2;

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