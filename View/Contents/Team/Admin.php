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
      <li>
        <a href="/team/members/<?php echo $parameters['teamId'] ?>">Members</a>
      </li>
      <?php
        $teamId = $parameters['teamId'];
        echo("<li class='active'>
                <a href='/team/admin/$teamId'>Admin</a>
              </li>");
      ?>
    </ul>
  </div>
  <div class="content_below">
    <div class="content_list">
      <ul>
        <?php
        foreach($parameters['members'] as $member)
        {
          $teamId = $parameters['teamId'];
          $userId = $member->getId();
          $email = $member->getEmail();
          $joinedAt = $member->getPrintableJoinedAt();
          echo("<li>
                    <div class='list_element_with_action'>
                        <div>email: $email </div>
                        <div>joined: $joinedAt</div>
                    </div>
                    <div class='team_action'>
                        <form action='/team/members/remove' method='POST'>
                            <input type='text' id='teamId' name='teamId' value='$teamId' style='display:none'>
                            <input type='text' id='userId' name='userId' value='$userId' style='display:none'>
                            <button class='button' type='submit' value='inv'>
                                <img src='/images/remove_item_icon_small.png'>
                            </button>
                        </form>
                    </div>
                </li>");
        }
        ?>
      </ul>
    </div>
    <div class="content_actions">
      <ul>
        <?php
        $teamId = $parameters['teamId'];
        echo "<li class='action_create'><div><img src='/images/plus_icon_very_small.png'></div><div class='team_invite_member'>Invite member</div></li>";
        echo "<li>
                <form action='/team/invite/send' method='POST'>
                    <div class='action_description'>
                        <input type='text' id='email' placeholder='email' name='email'>
                        <input type='text' id='teamId' name='teamId' value='$teamId' style='display:none'>
                    </div>
                    <div class='action_icon'>
                        <button class='button' type='submit'><img src='/images/invitation_send_icon_small.png'></button>
                    </div>
                </form>
               </li>";

        foreach($parameters['invitedUsers'] as $user)
        {
            $email = $user->getEmail();
            $userId = $user->getId();

            echo "<li>
                    <div class='action_description'><p>$email</p></div>
                    <div class='action_icon'>
                        <form action='/team/invite/remove' method='POST'>
                            <input type='text' id='teamId' name='teamId' value='$teamId' style='display:none'>
                            <input type='text' id='userId' name='userId' value='$userId' style='display:none'>
                            <button class='button' type='submit'><img src='/images/junk_icon_small.png'></button>
                        </form>
                    </div>
                  </li>";
        }
        ?>
      </ul>
    </div>
  </div>
</div>