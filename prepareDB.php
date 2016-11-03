<?php
  //check if script has been run using console
  include("isConsole.php");

  //drop existing database to be sure tables doesn't exists at start
  include("connect.php");

  $dropQuery = 'DROP DATABASE '.$dbName;
  $result = $mysqli->query($dropQuery);
  if($mysqli->connect_errno)
  {
    die("Failed to connect to database server.\r\n");
  }

  $createQuery = 'CREATE DATABASE '.$dbName;
  $result = $mysqli->query($createQuery);
  if($mysqli->connect_errno)
  {
    die("Failed to connect to database server.\r\n");
  }

  //restart connection, maybe jsut select db after recreating
  $mysqli->close();
  include("connect.php");

  $tablesCreationQueries = array
  (
    'CREATE TABLE users (
      id INT AUTO_INCREMENT NOT NULL,
      email VARCHAR(127) NOT NULL, 
      password VARCHAR(127) NOT NULL,
      salt VARCHAR(127) NOT NULL,
      surname VARCHAR(127) NOT NULL,
      name VARCHAR(127) NOT NULL,
      session_key VARCHAR(127),
      registered_at DATETIME,
      PRIMARY KEY(id),
      UNIQUE KEY email (email)     
    ) 
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE teams (
      id INT AUTO_INCREMENT NOT NULL,
      leader_id INT NOT NULL,
      name VARCHAR(127) NOT NULL,
      tag VARCHAR(15) NOT NULL,
      description VARCHAR(2000),
      created_at DATETIME,
      PRIMARY KEY(id),
      UNIQUE KEY leader_id (leader_id),
      CONSTRAINT teams_leader_id FOREIGN KEY (leader_id) REFERENCES users (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE teams_members (
      id INT AUTO_INCREMENT NOT NULL,
      user_id INT NOT NULL,
      team_id INT NOT NULL,
      joined_date DATETIME NOT NULL,
      status VARCHAR(15) NOT NULL,
      PRIMARY KEY(id),
      CONSTRAINT teams_members_user_id FOREIGN KEY (user_id) REFERENCES users (id),
      CONSTRAINT teams_members_team_id FOREIGN KEY (team_id) REFERENCES teams (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE tournaments (
      id INT AUTO_INCREMENT NOT NULL,
      admin_id INT NOT NULL,
      name VARCHAR(127) NOT NULL,
      description VARCHAR(2000),
      created_at DATETIME,
      PRIMARY KEY(id),
      CONSTRAINT tournaments_users_id FOREIGN KEY (admin_id) REFERENCES users (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE teams_tournaments (
      id INT AUTO_INCREMENT NOT NULL,
      team_id INT NOT NULL,
      tournament_id INT NOT NULL,
      joined_date DATETIME NOT NULL,
      PRIMARY KEY(id),
      CONSTRAINT teams_tournaments_team_id FOREIGN KEY (team_id) REFERENCES teams (id),
      CONSTRAINT teams_tournaments_tournament_id FOREIGN KEY (tournament_id) REFERENCES tournaments (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE matches (
      id INT AUTO_INCREMENT NOT NULL,
      tournament_id INT NOT NULL,
      match_date DATETIME NOT NULL,
      PRIMARY KEY(id),
      CONSTRAINT matches_tournaments_tournament_id FOREIGN KEY (tournament_id) REFERENCES tournaments (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE teams_matches (
      id INT AUTO_INCREMENT NOT NULL,
      match_id INT NOT NULL,
      team_id INT NOT NULL,
      scores INT,
      PRIMARY KEY(id),
      CONSTRAINT teams_matches_match_id FOREIGN KEY (match_id) REFERENCES matches (id),
      CONSTRAINT teams_matches_team_id FOREIGN KEY (team_id) REFERENCES teams (id)
    )
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',
  );

  foreach($tablesCreationQueries as $key => $query)
  {
    $mysqli->query($query);

    if($mysqli->connect_errno)
    {
      die("Failed to connect to database server.\r\n");
    }
  }

  //triggers
  $triggersCreationQueries = array
  (
    'CREATE TRIGGER tournament_creation 
      BEFORE INSERT ON tournaments 
      FOR EACH ROW
        SET NEW.created_at = NOW();
    ',

    'CREATE TRIGGER teams_creation 
      BEFORE INSERT ON teams 
      FOR EACH ROW
        SET NEW.created_at = NOW();
    ',

    'CREATE TRIGGER users_registration
      BEFORE INSERT ON users 
      FOR EACH ROW
        SET NEW.registered_at = NOW();
    ',
  );

  foreach($triggersCreationQueries as $key => $query)
  {
    $mysqli->query($query);

    if($mysqli->connect_errno)
    {
      die("Failed to connect to database server.\r\n");
    }
  }
  
?>