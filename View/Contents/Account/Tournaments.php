<div class="container">
    <div class="content_menu">
        <ul>
            <li class="active">
                <a href="/account/tournaments">Tournaments</a>
            </li>
            <li>
                <a href="/account/teams">Teams</a>
            </li>
        </ul>
    </div>
    <div class="content_below">
        <div class="content_list">
            <ul>
              <?php
              foreach($parameters['tournaments'] as $tournament)
              {
                $id = $tournament->getId();
                $name = $tournament->getName();
                $description = $tournament->getDescription();
                $participants = 999;//$team->getNumberOfTeams();
                echo("<li>
                            <a href='/tournament/$id'><div>$name</div><div>participants: $participants</div></a>
                          </li>");
                //<a class='team_resign' href='/teams/resign/$id'><img src='/images/sign-off-icon-small.png'></a>
              }
              ?>
            </ul>
        </div>
        <div class="content_actions">
            <ul>
              <?php
              // TODO tournaments
              // echo "<li><a href='/teams/create'><div><img src='/images/plus_icon_very_small.png'></div><div class='team_create'>Create new Team</div></a></li>";
              // echo "<li><div class='team_invites'>Pending invites: </div><div class='team_invites'>0</div></li>";
              // TODO team invites
              // echo "<li><a href='/teams/create'><img src='/images/sign-off-icon-small.png'></a></li>";
              //          foreach($parameters['teams'] as $team)
              //          {
              //            $id = $team->getId();
              //            $name = $team->getName();
              //            echo("<li>$name</li>");
              //          }
              ?>
            </ul>
        </div>
    </div>
</div>