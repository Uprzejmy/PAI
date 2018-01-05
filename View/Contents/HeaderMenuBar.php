<div class="container">
    <div class="header_menu">
        <div class="header_menu_logo">
            <h1>
                <img src="/images/cup-gold-icon-128.png" alt="cup logo" height="96" width="96">
                <a href="/homepage">Tournament Brackets</a>
            </h1>
        </div>
        <div class="header_menu_list">
            <ul>
                <?php
                    /** @var UserSession $session */
                    $session = $parameters['session'];
                    if(isset($session) && $session->isUserLogged())
                    {
                        $email = $session->getEmail();
                        echo ("<li><a href='/account'>Logged as: $email</a></li>");
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