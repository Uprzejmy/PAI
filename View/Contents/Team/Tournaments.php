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
      <li class="active">
        <a href="/team/tournaments/<?php echo $parameters['teamId'] ?>">Tournaments</a>
      </li>
      <li>
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
        foreach($parameters['tournaments'] as $tournament)
        {
          $id = $tournament->getId();
          $name = $tournament->getName();
          $createdAt = $tournament->getPrintableCreatedAt();
          echo("<li><a class='list_element' href='/tournaments/$id'><div>$name</div><div>Created At: $createdAt</div></a></li>");
        }
        ?>
      </ul>
    </div>
    <div class="content_actions">
      <ul>
        <li class="action_create"><a href='/team/create'><div><img src='/images/plus_icon_very_small.png'></div><div class='team_create'>Create new Team</div></a></li>
        <li class="action_create"><a href='/tournaments/create'><div><img src='/images/plus_icon_very_small.png'></div><div class='tournament_create'>Create new Tournament</div></a></li>
      </ul>
    </div>
  </div>
</div>