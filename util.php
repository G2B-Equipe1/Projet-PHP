<?php

function start_page() {
    ?>
    <!DOCTYPE>
    <html>
    <head>
        <title>Virtuo Linguo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body class="container-fluid">
    <?php
    set_gettext();
}

function set_gettext() {
    if  ($_GET["lang"] == "fr") {
        $lang = 'fr_FR';
        $filename = 'fr_FR';
    } else if  ($_GET["lang"] == "en") {
        $lang = 'en_US';
        $filename = 'en_US';
    } else {
        $lang = 'fr_FR';
        $filename = 'fr_FR';
    }
    putenv("LC_ALL=$lang");
    setlocale(LC_ALL, $lang);
    bindtextdomain($filename, 'lang');
    bind_textdomain_codeset($filename, "UTF-8");
    textdomain($filename);
}

function nav_bar() {
    ?>
    <nav class="container-fluid nav">
        <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 nav_col_1">
                <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'index.php';"><?php echo _('Home')?></button>
                <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'about.php';"><?php echo _('About')?></button>
                <button class="btn btn-default button_nav" type="button" onclick="window.location.href = 'contact.php';"><?php echo _('Contact')?></button>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 nav_col_2">
                <button class="btn btn-default button_nav hvr-bubble-left" type="button" onclick="window.location.href = '<?php $query = $_GET; $query['lang'] = 'fr';
                $query_result = http_build_query($query);
                echo $_SERVER['PHP_SELF'] . '?' . $query_result ?>' ">
                    <?php echo _('French')?></button>
                <button class="btn btn-default button_nav hvr-bubble-left" type="button" onclick="window.location.href = '<?php $query = $_GET; $query['lang'] = 'en';
                $query_result = http_build_query($query);
                echo $_SERVER['PHP_SELF'] . '?' . $query_result ?>'">
                    <?php echo _('English')?></button>
                <button class="btn btn-default button_nav hvr-bubble-left" type="button" onclick="window.location.href = 'user_space.php';">User</button>
            </div>
        </div>
    </nav>
    <?php
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