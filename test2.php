<?php

  include("connect.php");

  $query = $mysqli->prepare("SELECT id, email, password, name, surname FROM users");

  $query->execute();

  $result = $query->get_result();
  while($user = $result->fetch_assoc())
  {

  }

?>