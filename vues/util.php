<?php

function start_page() {
    if(!isset($_SESSION['lang']))
        $_SESSION['lang'] = 'en_US';
    if(isset($_GET['lang']))
        $_SESSION['lang'] = $_GET['lang'];
    ?>
    <!DOCTYPE>
    <html>
    <head>
        <title>Vituo Linguo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
    </head>

    <body>
    <?php
    set_gettext();
}

function set_gettext() {
    $lang = $_SESSION['lang'];
    $filename = $_SESSION['lang'];
    putenv("LC_ALL=$lang");
    setlocale(LC_ALL, $lang);
    bindtextdomain($filename, 'lang');
    bind_textdomain_codeset($filename, "UTF-8");
    textdomain($filename);
}

function nav_bar() {
    ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo 'index.php' ?>">Virtuo Linguo</a>
            </div>
            <ul class="nav navbar-nav">

                <li><a href="<?php echo 'about.php' ?>"><?php echo _('About')?></a></li>
                <li><a href="<?php echo 'translation.php' ?>"><?php echo _('Translation')?></a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="../user_space.php"><span class="glyphicon glyphicon-user"></span> <?php echo _('User')?></a></li>
                <?php
                if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Trad' || $_SESSION['categorie'] == 'Admin')) {
                    $tmp = _('Translator work place');
                    echo '<li><a href="../get_translation.php"><span class="glyphicon glyphicon-cog"></span> '.$tmp.'</a></li>';
                    unset($tmp);
                }
                if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'Admin') {
                    $tmp = _('Administration');
                    echo '<li><a href="../admin.php"><span class="glyphicon glyphicon-cog"></span> '.$tmp.'</a></li>';
                    unset($tmp);
                }
                ?>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo ($_SESSION['lang'] == 'fr_FR') ? 'img/fr.png' : 'img/en.png'?>" class="flag" alt="flag"/> <?php echo _('Language');?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php
                            echo $_SERVER['PHP_SELF'] . '?lang=en_US' ;  ?>"><?php echo _('English')?></a></li>
                        <li><a href="<?php
                            echo $_SERVER['PHP_SELF'] . '?lang=fr_FR';  ?>"><?php echo _('French')?></a></li>
                    </ul>
                </li>
            </ul>
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