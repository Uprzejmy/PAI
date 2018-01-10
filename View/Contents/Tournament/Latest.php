<div class="container">
  <div class="left-logo-adjuster">.</div>
  <div class="content_title">
    <p class='content_title_header'>&nbsp;</p>
  </div>
</div>
<div class="container">
  <div class="content_menu">
    <ul>
      <li class="active">
        <a href="/homepage">Latest Active Tournaments</a>
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

          echo("<li><a class='list_element' href='/tournaments/$id'><div>$name</div><div>Created At: $createdAt</div></a></li>");
        }
        ?>
      </ul>
    </div>
  </div>
</div>