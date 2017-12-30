<?php

function start_page() {
    $start = <<<EOT
<!DOCTYPE>
<html>
    <head>
        <title>Virtuo Linguo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body class="container-fluid">
EOT;
    echo $start;
}

function nav_bar() {
    $nav = <<<EOT
        <nav class="container-fluid">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><button class="btn btn-default" type="button" onclick="window.location.href = 'index.php';">Acceuil</button></div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><button class="btn btn-default" type="button" onclick="window.location.href = 'about.php';">A propos</button></div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><button class="btn btn-default" type="button" onclick="window.location.href = 'contact.php';">Nous contacter</button></div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><button class="btn btn-default" type="button" onclick="window.location.href = 'user_space.php';">Espace perso</button></div>
            </div>
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