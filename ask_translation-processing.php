<?php
session_start();
include_once 'modeles/base.php';

if(isset($_POST['action'])) {
    if ($_POST['action'] == 'Rechercher') { // tri par pertinnance

        if ($_POST['from'] == 'english')
            $query = 'SELECT DISTINCT word FROM translation';
        else $query = 'SELECT DISTINCT translation FROM translation WHERE lang="' . $_POST['from'] . '"';
        if (!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        if (mysqli_num_rows($dbResult) == 0) {
            echo '<p> Woops, il n\'y a encore aucune traduction sur le site </p>';
        }

        else {
            $best_score = 0;
            while ($dbRow = mysqli_fetch_row($dbResult)) {
                $score = 0;
                for ($i = 0; $i < strlen($dbRow[0]) && $i < strlen($_POST['to_find']) ; $i++){
                    if ($dbRow[0][$i] == $_POST['to_find'][$i]) $score += 1;
                }

                if ($score >= $best_score) {
                    $best_word = $dbRow[0];
                    $best_score = $score;
                }
            }
            $_SESSION['found'] = $best_word;
        }

        header('Location: ask_translation.php');
    }

    else if ($_POST['action'] == 'translate') {
        $_SESSION['resultat'] = search_translation($_GET['from'],$_GET['to'],$_SESSION['found']);
        $_SESSION['found'] = '';
        header('Location: ask_translation.php');
    }

    else {
        $_SESSION['to_translate'] = $_POST['to_ask'];
        $query = 'SELECT *
              FROM translation
              WHERE word=\'' . $_POST['to_ask'] . '\' OR translation=\'' . $_POST['to_ask'] . '\'';

        if (!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        if (mysqli_num_rows($dbResult) == 0) {
            $_SESSION['detectlang'] = ' Nous n\'avons pas de traduction de \'' . $_POST['to_ask'] . '\' en base de données <br> <br>';
            header('Location: ask_translation.php');
            exit();
        }
        $dbRow = mysqli_fetch_assoc($dbResult);

        $_SESSION['detectlang'] = $dbRow['word'] == $_POST['to_ask'] ? 'english<br>' : $dbRow['lang'] . '<br>';
        header('Location: ask_translation.php');
        exit();
    }

    if (!isset($_GET['from']) || !isset($_GET['to']) || !isset($_GET['to_ask'])) {
        header('Location: ask_translation.php');
        exit();
    }
}

if(strpos($_GET['to_ask'], "'") !== FALSE)
    $_GET['to_ask'] = str_replace("'", "\'", $_GET['to_ask']);

if($_GET['to'] == $_GET['from'] ){
    $_SESSION['samelang'] = 'Ne pas selectionner deux fois la même langue <br> ';
    header('Location: ask_translation.php');

    exit();
}


$from = $_GET['from'];
$to = $_GET['to'];
$to_translate = $_GET['to_ask'];

$query = 'INSERT INTO translation_request (user_id, word, from_lang, to_lang, state ) 
                      VALUES (\'' . $_SESSION['id'] . '\', \'' . $_GET['to_ask'] . '\', \''
    . $_GET['from'] . '\', \'' . $_GET['to'] . '\', \'en cours\' )';
$dbResult = mysqli_query($dbLink, $query);

header('Location: ask_translation.php');

?>