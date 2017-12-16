<div class="container">
    <div class="menu">
        <div class="menu_logo">
            <h1>
                <img src="/images/cup-gold-icon-128.png" alt="cup logo" height="96" width="96">
                <a href="homepage">Tournament Brackets</a>
            </h1>
        </div>
        <div class="menu_list">
            <ul>
                <?php
                    /** @var UserSession $session */
                    $session = $parameters['session'];
                    if(isset($session) && $session->isUserLogged())
                    {
                        $email = $session->getEmail();
                        echo ("<li><a href='/homepage'>Logged as: $email</a></li>"); //TODO user show page
                        echo ("<li><a href='/logout'>logout</a></li>");
                    }
                    else
                    {
                        echo ("<li><a href='/login'>login</a></li>");
                        echo ("<li><a href='/registration'>registration</a></li>");
                    }
                ?>
            </ul>
        </div>
    </div>
</div>