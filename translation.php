<?php
require 'base.php';
include_once 'langues.php';
include 'util.php';
session_start();
start_page();
nav_bar();
?>
        <form action="translation-processing.php" method="get">
            <select name="from">
                <?php set_options($_SESSION['from']); ?>
            </select>
            <input type="text" name="to_translate" <?php set_word($_SESSION['to_translate']); ?>/>
            <select name="to">
                <?php set_options($_SESSION['to']); ?>
            </select>
            <input type="submit" name="action" value="translate"/>
        </form>

<?php
echo $_SESSION['samelang'];
$_SESSION['samelang'] ='';
if (isset($_SESSION['resultat'])) {
    echo $_SESSION['resultat'];
    $_SESSION['resultat'] = null;
}
if (isset($_SESSION['get_trad'])) {
    echo $_SESSION['get_trad'];
    $_SESSION['get_trad'] = null;
}
if (isset($_SESSION['ask_trad'])) {
        echo $_SESSION['ask_trad'];
        $_SESSION['ask_trad'] = null;
}

if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad' || $_SESSION['categorie'] == 'Premium')){
    echo ' <br>Avantage Premium : <a href="ask_translation.php" class="btn">
            Détecter la langue d\'un mot / Demander une traduction /  Voir mon historique de demandes de traductions</a>';
}
if (isset($_SESSION['categorie']) && ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad')){
    echo '<br>Avantage Traducteur : <a href="get_translation.php" class="btn">
            Ajouter une nouvelle traduction / Gérer les demandes de traduction / Modifier une traduction existante</a>';
}

footer();
end_page();
?>
