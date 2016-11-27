<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>
    <a href="/homepage">Homepage</a>
    <a href="/login">Login</a>

    <form action="/registration" method="POST">
      <table>
        <tr><td>email</td><td><input type="text" name="email" placeholder="email"/></td></tr>
        <tr><td>password</td><td><input type="text" name="password" placeholder="password"/></td></tr>
        <tr><td>password2</td><td><input type="text" name="password2" placeholder="password2"/></td></tr>
        <tr><td>name</td><td><input type="text" name="name" placeholder="name"/></td></tr>
        <tr><td>surname</td><td><input type="text" name="surname" placeholder="surname"/></td></tr>
        <tr><td colspan=2><input type="submit" value="Register"/></td></tr>
        <tr><td colspan=2>
        <p>
          <?php
            if(isset($_COOKIE["registrationFormError"]))
              echo($_COOKIE["registrationFormError"]);
            setcookie("registrationFormError", "", time() - 3600); //time in the past tells browser to remove the cookie
          ?> 
        </p></td></tr>
      </table>
    </form>  
    
  </body>
</html>