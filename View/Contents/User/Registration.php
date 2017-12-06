<div>
  <form action="/registration" method="POST">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?php echo $parameters['email'] ?>">

    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo $parameters['username'] ?>">

    <label for="password">Password</label>
    <input type="password" id="password" name="password">

    <label for="password2">Password Confirmation</label>
    <input type="password" id="password2" name="password2">

    <input class="button" type="submit" value="Create an account">
  </form>
</div>