<?php
include_once 'vues/util.php';
include ('modeles/base.php');
include ('modeles/langues.php');
include_once 'vues/translation.php';
session_start();

start_page();
nav_bar();

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

footer();
end_page();
?>
