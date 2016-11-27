
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <a href="index.php">Homepage</a>
    <a href="login.php">Login</a>
    <a href="registration.php">Registration</a>

    <div class="login">
      <h1>Login</h1>
      <?php
        if(isset($_COOKIE["loginFormError"]))
          echo("<p>".$_COOKIE["loginFormError"]."</p>");
        setcookie("loginFormError", "", time() - 3600); //time in the past tells browser to remove the cookie
      ?> 
      <form action="login_submit.php" method="POST">
        <input type="text" name="email" placeholder="email"/>
        <input type="password" name="password" placeholder="password"/>
        <input class="button" type="submit" value="Login"/>
      </form>
      
    </div>
    
  </body>
</html>