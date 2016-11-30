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

    <div class="login">
      <h1>Registration</h1>
      <?php
        if(isset($_COOKIE["registrationFormError"]))
          echo("<p>".$_COOKIE["registrationFormError"]."</p>");
        setcookie("registrationFormError", "", time() - 3600); //time in the past tells browser to remove the cookie
      ?> 
      <form action="/registration" method="POST">
        <input type="text" name="email" placeholder="email"/>
        <input type="password" name="password" placeholder="password"/>
        <input type="password" name="password2" placeholder="password confirmation"/>
        <input type="text" name="name" placeholder="name"/>
        <input type="text" name="surname" placeholder="surname"/>
        <input class="button" type="submit" value="Create an account"/>
      </form>
      
    </div>
    
  </body>
</html>


    