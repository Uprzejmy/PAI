<div class="container">
    <div class="content_menu">
        <ul>
            <li>
                <a href="/account/tournaments">Tournaments</a>
            </li>
            <li class="active">
                <a href="/account/teams">Teams</a>
            </li>
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
                    $members = $team->getNumberOfMembers();
                    echo("<li>
                            <a href='/teams/$id'><div>$name</div><div>members: $members</div></a>
                            <a class='team_resign' href='/teams/resign/$id'><img src='/images/sign-off-icon-small.png'></a>
                          </li>");
                }
                ?>
            </ul>
        </div>
        <div class="content_actions">
            <ul>
              <?php
              echo "<li>actions</li>";
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