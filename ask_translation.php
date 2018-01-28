<?php
session_start();
include_once 'modeles/base.php';
include_once 'vues/util.php';
include_once 'modeles/langues.php';
include  'vues/ask_translation.php';

start_page();
nav_bar();

if (!isset($_SESSION['categorie']) ||  $_SESSION['categorie'] != 'Premium' && $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad'){
    header('Location: translation.php');
    exit();
}


pertinance();

ask_translation();

detect_lang();


?>
    <div class="container">
        <div class="page-header" style="margin-top: 0">
            <h1 style="margin-top: 0"><span class="glyphicon glyphicon-list-alt"></span>  <?php echo _('Historique de mes demandes')?></h1>
        </div>
        <?php

        $query = 'SELECT *
          FROM translation_request
          WHERE user_id=\''.$_SESSION['id'].'\'';
        $dbResult = mysqli_query($dbLink, $query);
        if (mysqli_num_rows($dbResult) == 0) {
            echo $query_result = '<div class="alert alert-info"><p> '. _('Vous n\'avez encore fais aucune demande'). ' </p></div>';
        } else {
            while ($dbRow = mysqli_fetch_assoc($dbResult)) {
                echo _('Demande de traduction du mot ') . $dbRow['word'] .
                    _(' de la langue ') . $dbRow['from_lang'] . _(' à la langue ') . $dbRow['to_lang'] .
                    ', '. _('statut : ') . $dbRow['state'] . '<br>';
            }
        }

echo '</div>';

if (isset($_SESSION['samelang'])) {echo $_SESSION['samelang']; unset($_SESSION['samelang']); }

footer();
end_page();
?>