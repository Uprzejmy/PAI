<div class="container">
  <div class="left-logo-adjuster">&nbsp;</div>
  <div class="content_title">
    <p class='content_title_header'>
      <?php
      $tournament = $parameters['tournament'];
      $name = $tournament->getName();
      echo "$name";
      ?>
    </p>
  </div>
</div>
<div class="container">
  <div class="content_menu">
    <ul>
      <li>
        <a href="/tournaments/<?php echo $parameters['tournamentId'] ?>">Bracket</a>
      </li>
      <li class="active">
        <a href="/tournaments/matches/<?php echo $parameters['tournamentId'] ?>">Matches</a>
      </li>
      <li>
        <a href='/tournaments/participants/<?php echo $parameters['tournamentId'] ?>'>Participants</a>
      </li>
      <?php
      $tournamentId = $parameters['tournamentId'];

      if($parameters['isUserLogged'] && !$parameters['isTournamentStarted'])
      {
        echo("<li>
                <a href='/tournaments/join/$tournamentId'>Join</a>
              </li>");
      }

      if($parameters['isUserAdmin'])
      {
        echo("<li>
                <a href='/tournaments/admin/$tournamentId'>Admin</a>
              </li>");
      }
      ?>
    </ul>
  </div>
  <div class="content_below">
    <div class="content_list">
      <ul>
        <?php

        foreach($parameters['matches'] as $match)
        {
          $leftTeamName = $match->leftTeamName;
          $leftTeamScore = $match->leftTeamScore;
          $rightTeamName = $match->rightTeamName;
          $rightTeamScore = $match->rightTeamScore;
          $matchDate = $match->getPrintableMatchDate();
          echo("<li class='simple_list'>
                  <div class='tournament_match_date'>
                    <div>$matchDate</div>
                  </div>
                  <div class='tournament_match_result'>
                    <div>
                      <div class='content_to_right'>$leftTeamScore</div>
                      <div class='content_to_right'>$leftTeamName</div>
                    </div>
                    <div>
                      <div class='content_to_left'>:$rightTeamScore</div>
                      <div class='content_to_left'>$rightTeamName</div>
                    </div>
                  </div>
                </li>");
        }
        ?>
      </ul>
    </div>
  </div>
</div>