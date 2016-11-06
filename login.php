
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

    <form action="login_submit.php" method="POST">
      <table>
        <tr><td>email</td><td><input type="text" name="email" placeholder="email"/></td></tr>
        <tr><td>password</td><td><input type="text" name="password" placeholder="password"/></td></tr>
        <tr><td colspan=2><input type="submit" value="Login"/></td></tr>
        <tr><td colspan=2>
        <p>
          <?php
            if(isset($_COOKIE["loginFormError"]))
              echo($_COOKIE["loginFormError"]);
            setcookie("loginFormError", "", time() - 3600); //time in the past tells browser to remove the cookie
          ?> 
        </p></td></tr>
      </table>
    </form>  
    
  </body>
</html>