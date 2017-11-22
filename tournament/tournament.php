<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/env.php");
  require_once($ROOT."/user/utils.php");
  require_once($ROOT."/connect.php");

  // validateUser($mysqli, $_COOKIE['email'], $_COOKIE['session_key'], $_COOKIE['token'], $userId);
/*
  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    //var_dump($_POST);
    //die();
    $anyFieldError = 0;

    if(!isset($_POST['name']) || empty($_POST['name']))
    {
      $nameFieldError = "Pole Name nie może być puste";
      $anyFieldError = 1;
    }

    if(!isset($_POST['description']) || empty($_POST['description']))
    {
      $descriptionFieldError = "Pole Description nie może być puste";
      $anyFieldError = 1;
    }

    if(!$anyFieldError)
    {
      $query = $mysqli->prepare("INSERT INTO tournaments (name, description, admin_id) values (?, ?, ?);");

      $query->bind_param('ssd', $_POST['name'], $_SERVER['description'], $userId);
      $query->execute();

      header('Location: ' . '/homepage'); //todo redirect to tournament show later
    }
  }
  */
  $tournamentNotFound = 1;

  if(isset($_GET['id']) && !empty($_GET['id']))
  {
    $query = $mysqli->prepare("SELECT tournamens.name as tournamentName, tournaments.description as tournamentDescription, tournamens.admin_id as adminId FROM tournaments WHERE id = ?;");

    $query->bind_param('d', $_GET['id']);
    $query->execute();

    $result = $query->get_result();
    $tournament = $result->fetch_assoc();

    if($tournament)
    {
      $tournamentNotFound = 0;
    }
  }
?>

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
    if($tournamentNotFound)
    {
      echo("<p>Nie odnaleziono turnieju</p>");
    }
    else
    {
      
    }
  ?>
  <form action="/createTournament" method="POST">
    <input type="text" name="name" placeholder="Tournament Name"/>
    <?php
      if(isset($nameFieldError))
        echo("<p>".$nameFieldError."</p>");
    ?> 
    <input type="text" name="description" placeholder="Description"/>
    <?php
      if(isset($descriptionFieldError))
        echo("<p>".$descriptionFieldError."</p>");
    ?> 
    <input class="button" type="submit" value="Create"/>
  </form>
</div>



<?php include($ROOT."/templates/bodyEnd.php"); ?>