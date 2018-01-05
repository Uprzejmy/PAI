<div class="container">
    <div class="left-logo-adjuster">&nbsp;</div>
    <div class="content_title">
        <p class='content_title_header'>&nbsp;</p>
    </div>
</div>
<div class="container">
    <div class="content_menu">
        <ul>
            <li class="active">
                <a href="/tournaments/1">Bracket</a>
            </li>
            <li>
                <a href="/tournaments/matches/1">Matches</a>
            </li>
        </ul>
    </div>
    <div class="content_below">
        <div class="content_list">
            <ul>
              <?php
              /*
              foreach($parameters['teams'] as $team)
              {
                $id = $team->getId();
                $name = $team->getName();
                $members = $team->getNumberOfMembers();
                echo("<li>
                                  <a href='/team/tournaments/$id'><div>$name</div><div>members: $members</div></a>
                                  <div class='team_action'>
                                      <form action='/team/self_remove' method='POST'>
                                          <input type='text' id='teamId' name='teamId' value='$id' style='display:none'>
                                          <button class='button' type='submit'>
                                              <img src='/images/sign-off-icon-small.png'>
                                          </button>
                                      </form>
                                  </div>
                                </li>");
              }
              */
              ?>
            </ul>
        </div>
        <div class="content_actions">
            <ul>
              <?php
              /*
              $countOfTeamInvitations = $parameters['countOfTeamInvitations'];
              echo "<li><a href='/team/create'><div><img src='/images/plus_icon_very_small.png'></div><div class='team_create'>Create new Team</div></a></li>";
              echo "<li><div class='team_invites'>Pending invites:</div><div class='team_invites'>$countOfTeamInvitations</div></li>";

              foreach($parameters['teamInvitations'] as $teamInvitation)
              {
                $id = $teamInvitation->getId();
                $name = $teamInvitation->getName();

                echo "<li>
                                  <form action='/team/invite/accept' method='POST'>
                                      <input type='text' id='teamId' name='teamId' value='$id' style='display:none'>
                                      <div class='invite_left'>
                                          <p>$name</p>
                                      </div>
                                      <div>
                                          <button class='button' type='submit'><img src='/images/tick_icon_small.png'></button>
                                      </div>
                                  </form>
                              </li>";
              }
              */
              ?>
            </ul>
        </div>
    </div>
</div>