<?php
  //check if script has been run using console
  include("isConsole.php");

  include("connect.php");

  //drop existing database to be sure tables doesn't exists at start
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

  echo "Tables import started..";

  // source: https://stackoverflow.com/questions/19751354/how-to-import-sql-file-in-mysql-database-using-php
  // Name of the file
  $filename = 'pai.sql';

  // Temporary variable, used to store current query
  $templine = '';
  // Read in entire file
  $lines = file($filename);
  // Loop through each line
  foreach ($lines as $line)
  {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        $mysqli->query($templine) or print('Error performing query: ' . $templine . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
  }
 echo "Tables imported successfully";
?>
  /*
  $tablesCreationQueries = array
  (
    'CREATE TABLE users (
      id INT AUTO_INCREMENT NOT NULL,
      email VARCHAR(127) NOT NULL, 
      password VARCHAR(127) NOT NULL,
      surname VARCHAR(127) NOT NULL,
      name VARCHAR(127) NOT NULL,
      registered_at DATETIME,
      PRIMARY KEY(id),
      UNIQUE KEY email (email)     
    ) 
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci 
    ENGINE = InnoDB    
    ',

    'CREATE TABLE sessions (
      id INT AUTO_INCREMENT NOT NULL,
      user_id INT NOT NULL,
      ip VARCHAR(64) NOT NULL,
      agent VARCHAR(128) NOT NULL,
      created_at DATETIME,
      session_key VARCHAR(128) NOT NULL,
      PRIMARY KEY(id),
      CONSTRAINT sessions_user_id FOREIGN KEY (user_id) REFERENCES users (id)
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

    'CREATE TRIGGER session_creation
      BEFORE INSERT ON sessions 
      FOR EACH ROW
        SET NEW.created_at = NOW();
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

  //example data
  $adminPassword = password_hash("admin",PASSWORD_DEFAULT);
  $query = "INSERT INTO users (email, password, name, surname) VALUES ('admin', '".$adminPassword."', 'admin', 'admin')";

  $result = $mysqli->query($query);

  if($mysqli->connect_errno)
  {
    echo("Can't get user info\r\n");
    die();
  }

?>
*/
