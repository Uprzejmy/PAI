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
      <li class="active">
        <a href="/tournaments/participants/<?php echo $parameters['tournamentId'] ?>">Participants</a>
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

        foreach($parameters['teams'] as $team)
        {
          $id = $team->getId();
          $name = $team->getName();
          $joinedAt = $team->getPrintableJoinedAt();
          echo("<li><div class='list_element'><div>$name</div>");

          if($parameters['isUserAdmin'] && !$parameters['isTournamentStarted'])
          {
              echo("<div class='tournament_action'>
                        <form action='/tournaments/remove_team' method='POST'>
                            <input type='text' id='teamId' name='teamId' value='$id' style='display:none'>
                            <input type='text' id='tournamentId' name='tournamentId' value='$tournamentId' style='display:none'>
                            <button class='button' type='submit'>
                                <img src='/images/remove_item2_icon.png'>
                            </button>
                        </form>
                    </div>");
          }

          echo("<div>Joined At: $joinedAt</div></div></li>");
        }

        ?>
      </ul>
    </div>
  </div>
</div>