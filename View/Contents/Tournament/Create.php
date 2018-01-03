<div class="container">
  <div class="all_forms">
    <ul class="form_errors">
      <?php
      foreach($parameters['form_errors'] as $error)
        echo("<li>$error</li>");
      ?>
    </ul>
    <form action="/tournaments/create" method="POST">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo $parameters['name'] ?>">

      <input class="button" type="submit" value="Create">
    </form>
  </div>
</div>