<div class="container">
    <div class="all_forms">
        <ul class="form_errors">
          <?php
              foreach($parameters['form_errors'] as $error)
                echo("<li>$error</li>");
          ?>
        </ul>
        <form action="/login" method="POST">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $parameters['email'] ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <input class="button" type="submit" value="log in">
        </form>
    </div>
</div>