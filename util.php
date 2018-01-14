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
        <nav class="container-fluid nav">
            <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 nav_col_1">
                    <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'index.php';">Acceuil</button>
                    <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'about.php';">A propos</button>
                    <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'contact.php';">Nous contacter</button>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 nav_col_2">
                    <button class="btn btn-default button_nav hvr-bubble-left" type="button" onclick="window.location.href = 'user_space.php';">User</button>
                </div>
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

function confirm_mail($to, $pseudo, $code) {
    $from = 'mysql-projet-php-g2b-equipe1@alwaysdata.net';
    $reply = 'no-reply@always.net';
    $subject = 'Mail de confirmation';

    $headers = 'From: Name <' . $from . '>' . "\n";
    $headers .= 'Return-Path: <' . $reply . '>' . "\n";
    $headers .= 'Content-type: text/plain; charset=utf-8';
    $message = "Salutations  $pseudo ! \n Voici le code à copier/coller sur la page d'activation du mail : 
         $code \n A très vite sur notre site ! \n\n";

    mail($to, $subject, $message, $headers);
}