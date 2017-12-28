<?php

function start_page() {
    $start = <<<EOT
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body>
EOT;
    echo $start;
}

function nav_bar() {
    $nav = <<<EOT
        <nav>
            <ul>
                <li><button type="button" onclick="window.location.href = 'index.php';">Acceuil</button></li>
                <li><button type="button" onclick="window.location.href = 'about.php';">A propos</button> </li>
                <li><button type="button" onclick="window.location.href = 'contact.php';">Nous contacter</button></li>
                <li><button type="button" onclick="window.location.href = 'user_space.php';">Espace perso</button></li>
            </ul>
        </nav>
EOT;
    echo $nav;
}

function footer() {
    $footer = <<<EOT
        <footer></footer>
EOT;
    echo $footer;
}

function end_page() {
    $end = <<<EOT
    </body>
</html>
EOT;
    echo $end;
}