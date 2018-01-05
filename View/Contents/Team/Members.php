<div class="container">
    <div class="left-logo-adjuster">.</div>
    <div class="content_title">
      <?php
      $team = $parameters['team'];
      $name = $team->getName();
      echo "<p class='content_title_header'>$name</p>";
      ?>
    </div>
</div>
<div class="container">
  <div class="content_menu">
    <ul>
      <li>
        <a href="/team/tournaments/<?php echo $parameters['teamId'] ?>">Tournaments</a>
      </li>
      <li class="active">
        <a href="/team/members/<?php echo $parameters['teamId'] ?>">Members</a>
      </li>
      <?php
      if($parameters['isUserAdmin'])
      {
        $teamId = $parameters['teamId'];
        echo("<li>
                <a href='/team/admin/$teamId'>Admin</a>
              </li>");
      }
      ?>
    </ul>
  </div>
  <div class="content_below">
    <div class="content_list">
      <ul>
        <?php
        foreach($parameters['members'] as $member)
        {
          $email = $member->getEmail();
          $joinedAt = $member->getPrintableJoinedAt();
          echo("<li><div class='list_element'><div>email: $email </div><div>joined: $joinedAt</div></div></li>");
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