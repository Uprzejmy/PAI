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
            <?php
            if($parameters['isUserAdmin'])
            {
                $tournamentId = $parameters['tournamentId'];
              echo("<li>
                      <a href='/tournaments/admin/participants/$tournamentId'>Participants</a>
                    </li>");
              echo("<li>
                      <a href='/tournaments/admin/settings/$tournamentId'>Settings</a>
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