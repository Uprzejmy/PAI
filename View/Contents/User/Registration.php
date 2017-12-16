<div class="container">
    <div class="all_forms">
        <ul class="form_errors">
          <?php
              foreach($parameters['form_errors'] as $error)
                echo("<li>$error</li>");
              ?>
        </ul>
        <form action="/registration" method="POST">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $parameters['email'] ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <label for="password2">Password Confirmation</label>
            <input type="password" id="password2" name="password2">

            <input class="button" type="submit" value="Create an account">
        </form>
    </div>
</div>