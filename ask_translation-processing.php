<?php
session_start();
include_once 'modeles/base.php';

// Fonction qui renvoi le nom d'un utilisateur en fonction de son id passé en paramètre
function search_user($id) {
    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $query = 'SELECT pseudo FROM user WHERE id='.$id;

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }


    while ($dbRow = mysqli_fetch_assoc($dbResult)) {
        $query_result = $dbRow['pseudo'];
    }
    return $query_result;
}

/* Fonction permettant de chercher la traduction d'un mot dans la base de donnée
   Renvoie le résultat de la requete en tant que string */
function search_translation($from, $to, $to_translate) {

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $to_translate= mysqli_real_escape_string($dbLink, $to_translate);

    mb_strtolower($to_translate);

    // Requetes a effectue suivant les cas :
    // cas de demande de traduction d'un mot anglais vers n'importe quelle langue
    if ($from == 'english' && $to != 'english') {

        $to_translate= mysqli_real_escape_string($dbLink, $to_translate);
        $query = 'SELECT user_id, translation, word, date, notation, nb_notation
              FROM translation
              WHERE word=\''.$to_translate.'\' AND lang=\''.$to.'\'' ;

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Traducteur</th>
                                    <th scope="col">Traduction</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>';
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> Woops, nous n\'avons pas de traduction de \''.$to_translate.'\' en '.$to.'. </p>';
        }
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $rowResult =    '<tr>
                                <td>'.search_user($dbRow['user_id']).'</td>
                                <td>'.$dbRow['translation'].'</td>
                                <td>'.$dbRow['date'].'</td>
                             </tr>';
            $query_result = $query_result . $rowResult . "\n";
        }
        $query_result = $query_result . '</tbody></table>';
        return $query_result;
    }

    // cas de demande pour traduction d'un mot pas anglais vers un mot anglais
    if ($to == 'english' && $from != 'english') {
        $query = 'SELECT user_id, word, translation, word, lang, date, notation, nb_notation
                  FROM translation
                  WHERE lang=\''.$from.'\'
                  AND translation=\''.$to_translate.'\'';

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Traducteur</th>
                                    <th scope="col">Traduction</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>';
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> Woops, nous n\'avons pas de traduction de \''.$to_translate.'\' en '.$to.'. </p>';
        }
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $rowResult =    '<tr>
                                <td>'.search_user($dbRow['user_id']).'</td>
                                <td>'.$dbRow['word'].'</td>
                                <td>'.$dbRow['date'].'</td>
                             </tr>';
            $query_result = $query_result . $rowResult . "\n";
        }
        $query_result = $query_result . '</tbody></table>';
        return $query_result;
    }

    // cas de demande de traduction pour un mot pas anglais vers un mot pas anglais non plus
    if ($from != 'english' && $to != 'english') {
        $query = 'SELECT user_id, word, translation, lang, date, notation, nb_notation
                      FROM translation
                      WHERE lang=\'' . $to . '\'
                      AND word IN (SELECT word
                                   FROM translation
                                   WHERE lang=\'' . $from . '\'
                                   AND translation = \'' . $to_translate . '\')';

        if (!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }

        $query_result = null;
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> Woops, nous n\'avons pas de traduction de \''.$to_translate.'\' en '.$to.'. </p>';
        }
        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Traducteur</th>
                                    <th scope="col">Traduction</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>';
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $rowResult =    '<tr>
                                <td>' . search_user($dbRow['user_id']) . '</td>
                                <td>' . $dbRow['translation'] . '</td>
                                <td>' . $dbRow['date'] . '</td>
                             </tr>';
            $query_result = $query_result . $rowResult . "\n";
        }
        $query_result = $query_result . '</tbody></table>';
        return $query_result;
    }
}

if(isset($_POST['action'])) {
    if ($_POST['action'] == 'Rechercher') { // tri par pertinnance
        $_SESSION['from'] = $_POST['from'];


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

    else if ($_POST['action'] == 'Traduire') {
        $_SESSION['resultat'] = search_translation($_POST['from'],$_POST['to'],$_POST['to_translate']);
        header('Location: ask_translation.php');
    }

    else {
        $_SESSION['to_translate'] = $_POST['to_ask'];
        $_POST['to_ask']= mysqli_real_escape_string($dbLink, $_POST['to_ask']);

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

$_GET['to_ask']= mysqli_real_escape_string($dbLink, $_GET['to_ask']);

$query = 'INSERT INTO translation_request (user_id, word, from_lang, to_lang, state ) 
                      VALUES (\'' . $_SESSION['id'] . '\', \'' . $_GET['to_ask'] . '\', \''
    . $_GET['from'] . '\', \'' . $_GET['to'] . '\', \'en cours\' )';
$dbResult = mysqli_query($dbLink, $query);

header('Location: ask_translation.php');

?>