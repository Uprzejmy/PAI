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
                $createdAt = $tournament->getPrintableCreatedAt();
                echo("<li>
                        <a href='/tournaments/$id'><div>$name</div><div>created at: $createdAt</div></a>
                      </li>");
              }
              ?>
            </ul>
        </div>
        <div class="content_actions">
            <ul>
              <?php
               echo "<li>
                        <a href='/tournaments/create'>
                            <div><img src='/images/plus_icon_very_small.png'></div>
                            <div class='tournament_create'>Create new Tournament</div>
                        </a>
                     </li>";
              ?>
            </ul>
        </div>
    </div>
</div>