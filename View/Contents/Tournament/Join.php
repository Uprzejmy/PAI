<div class="container">
  <div class="left-logo-adjuster">&nbsp;</div>
  <div class="content_title">
    <p class='content_title_header'>
      <?php
      $tournament = $parameters['tournament'];
      $name = $tournament->getName();
      echo($name);
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
        <a href='/tournaments/participants/<?php echo $parameters['tournamentId'] ?>'>Participants</a>
      </li>
      <li class="active">
        <a href="/tournaments/join/<?php echo $parameters['tournamentId'] ?>">Join</a>
      </li>
      <?php
      if($parameters['isUserAdmin'])
      {
        $tournamentId = $parameters['tournamentId'];
        echo("<li>
                <a href='/tournaments/admin/$tournamentId'>Admin</a>
              </li>");
      }
      ?>
    </ul>
  </div>
  <div class="content_below">
    <div class="content_list">
        <div class="all_forms join_form">
          <?php
          $userAdminTeams = $parameters['userAdminTeams'];
          $tournamentId = $parameters['tournamentId'];

          if($parameters['isUserInTournament'])
          {
              echo("<p>One of your teams has already joined the tournament</p>");
          }
          else if(count($userAdminTeams) > 0)
          {
              echo("<ul class='form_errors'>");
              foreach($parameters['form_errors'] as $error)
              {
                echo("<li>$error</li>");
              }
              echo("</ul>");

              echo("<label for='teamId'>Select your team</label>");
              echo("<select name='teamId' form='joinForm'>");
              foreach($userAdminTeams as $team)
              {
                  $name = $team->getName();
                  $id = $team->getId();
                  echo("<option value='$id'>$name</option>");
              }
              echo("</select>");

              echo("<form action='/tournaments/join/$tournamentId' method='POST' id='joinForm'>
                        <input type='text' id='tournamentId' name='tournamentId' value='$tournamentId' style='display:none'>
                        <input class='button' type='submit' value='Join'>
                    </form>");
          }
          else
          {
              echo("<p>You are not captain of any team at the moment</p>");
          }
          ?>
    </div>
  </div>
</div>