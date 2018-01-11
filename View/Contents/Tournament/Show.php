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
            <li class="active">
                <a href="/tournaments/<?php echo $parameters['tournamentId'] ?>">Bracket</a>
            </li>
            <li>
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
    <div class="content_tournament">
        <div class="tournament_description">
          <?php
          $tournament = $parameters['tournament'];
          $description = $tournament->getDescription();

          echo("<p>$description</p>");
          ?>
        </div>
        <div class="tournament_content">
            <?php
                echo($parameters['bracketView']);
            ?>
        </div>
    </div>
</div>