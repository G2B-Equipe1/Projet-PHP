<?php
require 'base.php';
session_start();
function search_translation() {

    $from = $_GET['from'];
    $to = $_GET['to'];
    $to_translate = $_GET['to_translate'];

    mb_strtolower($to_translate);

    $dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    if ($from == 'french' && $to == 'english') {

        $query = 'SELECT user_id, translation, word, date, notation, nb_notation
              FROM `translation`
              WHERE translation=\''.$to_translate.'\' AND lang=\''.$from.'\'' ;

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        if (mysqli_num_rows($dbResult) == 0) {
            echo "lol";
            exit();
        }

        $query_result = "";
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $rowResult = 'User n°'.$dbRow['user_id'].' propose '.$dbRow['word'].' (ajouté le '.$dbRow['date'].') Evaluée à '.$dbRow['notation'].' par '.$dbRow['nb_notation'].' personnes </br>';
            $query_result = $query_result . $rowResult . "\n";
        }
        return $query_result;
    }

    if ($from == 'english' && $to == 'french') {
        $query = 'SELECT user_id, word, translation, lang, date, notation, nb_notation
              FROM `translation`
              WHERE word = \''.$to_translate.'\'';

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        $query_result = "";
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $rowResult = 'User n°'.$dbRow['user_id'].' propose '.$dbRow['translation'].' (ajouté le '.$dbRow['date'].') Evaluée à '.$dbRow['notation'].' par '.$dbRow['nb_notation'].' personnes </br>';
            $query_result = $query_result . $rowResult . "\n";
        }
        return $query_result;
    }
}

if (!(isset($_SESSION['categorie']))) {
    $_SESSION['resultat'] = search_translation();
    header('Location: translation.php');
}
else if ($_SESSION['categorie'] == 'standar') {
    $_SESSION['resultat'] = search_translation();
    header('Location: translation.php');
}
else if ($_SESSION['categorie'] == 'prenium') {
    $_SESSION['resultat'] = search_translation();
    header('Location: translation.php');
}


?>
