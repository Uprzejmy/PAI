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
                    echo("<li><a href='/teams/$id'>$name</a></li>");
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