<?php
session_start();

if(strpos($_GET['to_translate'], "'") !== FALSE)
    $_GET['to_translate'] = str_replace("'", "\'", $_GET['to_translate']);

if($_GET['to'] == $_GET['from'] ){
    $_SESSION['samelang'] = '<p> ' ._('Ne pas selectionner deux fois la même langue') . ' </p>';
    header('Location: translation.php');
    exit();
}

function search_user($id) {
    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $query = 'SELECT pseudo FROM user WHERE id='.$id;

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo _('Erreur dans requête') . '<br />';
// Affiche le type d'erreur.
        echo _('Erreur : ') . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
        echo _('Requête : ') . $query . '<br/>';
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
    if(isset($_COOKIE['timer']) && !isset($_SESSION['categorie'])){
        $_SESSION['non-log'] = '!';
        header('Location: translation.php');
        exit();
    }

    setcookie("timer","non-log",time()+600);


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
        $query = 'SELECT user_id, translation, word, date, notation, nb_notation
              FROM translation
              WHERE word=\''.$to_translate.'\' AND lang=\''.$to.'\'' ;

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo _('Erreur dans requête') .'<br />';
// Affiche le type d'erreur.
            echo _('Erreur : ') . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo _('Requête : ') . $query . '<br/>';
            exit();
        }

        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">'. _('Traducteur') .'</th>
                                    <th scope="col">'. _('Traduction') . '</th>
                                    <th scope="col">'. _('Date') . '</th>
                                </tr>
                            </thead>
                            <tbody>';
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> '. _('Woops, nous n\'avons pas de traduction de ') .$to_translate.'\' en '.$to.'. </p>';
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
            echo _('Erreur dans requête') . '<br />';
// Affiche le type d'erreur.
            echo _('Erreur : ') . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo _('Requête : ') . $query . '<br/>';
            exit();
        }

        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">'. _('Traducteur') .'</th>
                                    <th scope="col">'. _('Traduction') . '</th>
                                    <th scope="col">'. _('Date') . '</th>
                                </tr>
                            </thead>
                            <tbody>';
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> '. _('Woops, nous n\'avons pas de traduction de ') .$to_translate.'\' en '.$to.'. </p>';
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
            echo _('Erreur dans requête') . '<br />';
// Affiche le type d'erreur.
            echo _('Erreur : ') . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
            echo _('Requête : ') . $query . '<br/>';
            exit();
        }

        $query_result = null;
        if (mysqli_num_rows($dbResult) == 0) {
            return $query_result = '<p> '. _('Woops, nous n\'avons pas de traduction de ') .$to_translate.'\' en '.$to.'. </p>';
        }
        $query_result = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">'. _('Traducteur') .'</th>
                                    <th scope="col">'. _('Traduction') . '</th>
                                    <th scope="col">'. _('Date') . '</th>
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

// Sauvegarde des éléments clés de la recherche dans $_SESSION pour pouvoir l'utliser dans plusieurs pages

$from = $_GET['from'];
$to = $_GET['to'];
$to_translate = $_GET['to_translate'];

mb_strtolower($to_translate);

$_SESSION['from'] = $from;
$_SESSION['to'] = $to;
$_SESSION['to_translate'] = $to_translate;

// Action a suivre suivant les différents utilisateurs

$_SESSION['resultat'] = search_translation($_GET['from'],$_GET['to'], $_GET['to_translate']);

//if( $_SESSION['resultat'][0] != 'U'  ){
//    if ($_SESSION['categorie'] == 'Premium' ) {
//        $_SESSION['ask_trad'] = '<a href="ask_translation.php"class="btn">Demander une traduction</a>';
//    }
//    else if ($_SESSION['categorie'] == 'Admin' || $_SESSION['categorie'] == 'Trad') {
//        $_SESSION['get_trad'] = '<a href="get_translation.php" class="btn">Donner une traduction</a>';
//        $_SESSION['ask_trad'] = '<a href="ask_translation.php" class="btn">Demander une traduction</a>';
//    }
//}

header('Location: translation.php');

?>