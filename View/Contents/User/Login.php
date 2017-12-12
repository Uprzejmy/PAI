<div class="container">
    <form action="/login" method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo $parameters['email'] ?>">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <input class="button" type="submit" value="log in">
    </form>
</div>