<?php
include_once 'vues/util.php';
include ('modeles/base.php');
include ('modeles/langues.php');
include_once 'vues/translation.php';
session_start();

start_page();
nav_bar();

if (!isset($_SESSION['categorie']) && $_COOKIE["timer"]) {
    echo 'Cela fait moins de 10 minute que vous avez effectué votre dernière traduction<br>
Si vous voulez en faire autant que vous voulez, veuilez vous connecter.';

}
else {
    translation_body();

    if (isset($_SESSION['get_trad'])) {
        echo $_SESSION['get_trad'];
        $_SESSION['get_trad'] = null;
    }
    if (isset($_SESSION['ask_trad'])) {
        echo $_SESSION['ask_trad'];
        $_SESSION['ask_trad'] = null;
    }

    if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad' || $_SESSION['categorie'] == 'Premium'))
        avantages_prenium();
    else if (isset($_SESSION['categorie']) && $_SESSION['categorie'] == 'Standard')
        standart();
    else
        pas_connecte();

    echo '</div></br></br>';
}

footer();
end_page();
?>
