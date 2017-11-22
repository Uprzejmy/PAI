<?php include($ROOT."/templates/headStart.php"); ?>

<title>Turniej</title>

<?php include($ROOT."/templates/headEnd.php"); ?>

<?php include($ROOT."/templates/menuBar.php"); ?>

<div class="example">
  <p>
    <?php
      if(isset($_COOKIE['email']))
        echo("Zalogowano jako: ".$_COOKIE['email']);
      else
        echo("niezalogowano");
    ?>
  </p>
</div>

<div class="tournament">
  <?php 
      echo("<p>Nie odnaleziono turnieju</p>");
  ?>
</div>