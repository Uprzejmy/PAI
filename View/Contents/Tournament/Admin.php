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
      <li>
        <a href="/tournaments/matches/<?php echo $parameters['tournamentId'] ?>">Matches</a>
      </li>
      <li>
        <a href="/tournaments/participants/<?php echo $parameters['tournamentId'] ?>">Participants</a>
      </li>
        <?php
        $tournamentId = $parameters['tournamentId'];

        if(!$parameters['isTournamentStarted'])
        {
          echo("<li>
                  <a href='/tournaments/join/$tournamentId'>Join</a>
                </li>");
        }

        echo("<li class='active'>
                <a href='/tournaments/admin/$tournamentId'>Admin</a>
              </li>");
      ?>
    </ul>
  </div>
  <div class="content_below">
    <div class="content_list">
      <ul>
        <?php
        $tournament = $parameters['tournament'];
        $tournamentId = $parameters['tournamentId'];
        if(!$tournament->isStarted())
        {
          echo("<li>
                  <div class='start_tournament_action'>
                
                    <form action='/tournaments/start' method='POST'>
                      <input type='text' id='tournamentId' name='tournamentId' value='$tournamentId' style='display:none'>
                      <button class='button' type='submit'>
                          Start Tournament!
                      </button>
                    </form>
                  </div>
                </li>");
        }

        $options = "";
        for($i=0;$i<50;$i++)
        {
            $options .= "<option value='$i'>$i</option>";
        }

        foreach($parameters['matchesToReport'] as $match)
        {
          $matchId = $match->matchId;
          $leftTeamName = $match->leftTeamName;
          $rightTeamName = $match->rightTeamName;

          echo("<li class='simple_list'>
                  <div class='tournament_match'>
                    <div class='tournament_report_score'>
                      <div class='left'>
                        <div class='content_to_right'>
                          <select name='leftScore' form='matchScoreForm$matchId'>$options</select>
                        </div>
                        <div class='content_to_right'>
                          $leftTeamName
                        </div>
                      </div>
                      <div class='right'>
                        <div class='content_to_left'>
                          <select name='rightScore' form='matchScoreForm$matchId'>$options</select>
                        </div>
                        <div class='content_to_left'>
                          $rightTeamName
                        </div>
                      </div>
                    </div>
                    <div class='tournament_score_form'>
                      <form action='/tournaments/report_score' method='POST' id='matchScoreForm$matchId'>
                        <input type='text' id='matchId' name='matchId' value='$matchId' style='display:none'>
                        <input type='text' id='tournamentId' name='tournamentId' value='$tournamentId' style='display:none'>
                        <button class='button' type='submit'>
                          <img src='/images/tick_icon_small.png'>
                        </button>
                      </form>
                    </div>
                  </div>
                </li>");
        }
        ?>
      </ul>
    </div>
  </div>
</div>