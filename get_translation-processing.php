<?php
require 'base.php';
require_once 'langues.php';
session_start();
if (!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' && $_SESSION['categorie'] != 'Trad') {
    header('Location: translation.php');
    exit();
}



if(strpos($_POST['to_translate'], "'") !== FALSE)
    $_POST['to_translate'] = str_replace("'", "\'", $_POST['to_translate']);
if(strpos($_POST['translation'], "'") !== FALSE)
    $_POST['translation'] = str_replace("'", "\'", $_POST['translation']);




$action = $_POST['action'];

if($action == 'New translation'){
    if($_POST['to'] == $_POST['from'] ){
        $_SESSION['samelang'] = 'Ne pas selectionner deux fois la même langue <br> ';
        header('Location: get_translation.php');
        exit();
    }
    $today = date('Y-m-d');
    if($_POST['to'] != 'english' && $_POST['from'] == 'english' ){

        $query = 'INSERT INTO translation (user_id, word, translation, lang, date)
              VALUES(\'' . $_SESSION['id'] . '\', \'' . $_POST['to_translate'] . '\', \'' .
            $_POST['translation'] . '\', \'' .$_POST['to'] . '\', \'' . $today . '\' )' ;

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION['to_translate'] =  $_POST['to_translate'];
        $_SESSION['to'] =  $_POST['to'];
        $_SESSION['add_success'] = 'Traduction ajoutée avec succes <br> <br>';
        header('Location: get_translation.php');
    }
    else if($_POST['to'] == 'english' && $_POST['from'] != 'english') {

        $query = 'INSERT INTO translation (user_id, word, translation, lang, date)
              VALUES(\'' . $_SESSION['id'] . '\', \'' . $_POST['translation'] . '\', \'' .
            $_POST['to_translate'] . '\', \'' . $_POST['from'] . '\', \'' . $today . '\' )' ;

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur dans requête<br />';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION['to_translate'] =  $_POST['to_translate'];
        $_SESSION['to'] =  $_POST['to'];
        $_SESSION['add_success'] = 'Traduction ajoutée avec succes <br> <br>';
        header('Location: get_translation.php');
    }
    else{
        header('Location: get_translation.php');
        exit();
    }

}
else if($action == 'Résoudre'){
    check_requests();
    unset($_SESSION['resolve_trad2']);
    $restrad = 'Résoudre la demande de traduction suivante : <b>' . $_POST['word'] .
        '</b> de la langue <b>' . $_POST['from_lang'] . '</b> à la langue <b>' . $_POST['to_lang'] . '</b>';
    if($_POST['from_lang'] == 'english' || $_POST['to_lang'] == 'english' ){
        $_SESSION['resolve_trad'] = $restrad;
        $_SESSION['from'] = $_POST['from_lang'];
        $_SESSION['to'] = $_POST['to_lang'];
    }
    else{
        $restrad .= '<br>Pour cela, remplissez les deux traductions suivantes : <br>';
        $_SESSION['resolve_trad2'] = $restrad;
        $_SESSION['tradtemp'] = '';
        $_SESSION['from'] = $_POST['from_lang'];
        $_SESSION['from2'] = 'english';
        $_SESSION['to'] = 'english';
        $_SESSION['to2'] = $_POST['to_lang'];
    }
    $_SESSION['to_translate'] = $_POST['word'];
    header('Location: get_translation.php');
    exit();
}
else if($action == 'Première étape'){
    if($_POST['to'] == $_POST['from'] ){
        $_SESSION['samelang'] = 'Ne pas selectionner deux fois la même langue <br> ';
        header('Location: get_translation.php');
        exit();
    }
    $_SESSION['tradtemp'] = $_POST['translation'];
    header('Location: get_translation.php');
    exit();
}
else if($action == 'Seconde étape'){
    if($_POST['to'] == $_POST['from'] ){
        $_SESSION['samelang'] = 'Ne pas selectionner deux fois la même langue <br> ';
        header('Location: get_translation.php');
        exit();
    }
    if($_SESSION['tradtemp'] == ''){
        $_SESSION['firstfirst'] = '<b>Vous devez d\'abord valider la première étape</b><br>';
        header('Location: get_translation.php');
        exit();
    }
    $today = date('Y-m-d');
    $query = 'INSERT INTO translation (user_id, word, translation, lang, date)
              VALUES(\'' . $_SESSION['id'] . '\', \'' . $_SESSION['tradtemp'] . '\', \'' .
        $_SESSION['to_translate'] . '\', \'' .$_SESSION['from'] . '\', \'' . $today . '\' )' ;
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $query = 'INSERT INTO translation (user_id, word, translation, lang, date)
              VALUES(\'' . $_SESSION['id'] . '\', \'' . $_SESSION['tradtemp'] . '\', \'' .
        $_POST['translation'] . '\', \'' .$_SESSION['to2'] . '\', \'' . $today . '\' )' ;
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $_SESSION['add_success'] = 'Traduction ajoutée avec succes <br> <br>';
    unset($_SESSION['resolve_trad2']);
    header('Location: get_translation.php');
}
else if($action == 'Refuser'){

    $query = 'UPDATE translation_request SET state = \'refusé\' WHERE id = \'' . $_POST['id'] . '\'';
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    header('Location: get_translation.php');
    exit();

}
else if($action == 'Modifier'){

    unset($_SESSION['resolve_trad2']);
    $_SESSION['modiftrad'] = 'Modifier la traduction existante suivante : <b>' . $_POST['word'] .
        '</b> en <b>' . $_POST['lang'] . '</b> donne <b>' . $_POST['translation'] . '</b>';
    $_SESSION['modifid'] = $_POST['id'];
    $_SESSION['from'] = 'english';
    $_SESSION['to'] = $_POST['lang'];
    $_SESSION['to_translate'] = $_POST['word'];
    header('Location: get_translation.php');
    exit();
}
else if($action == 'Modifier traduction'){
    $query = 'UPDATE translation SET translation = \'' . $_POST['translation'] .
        '\' WHERE trad_id = \'' . $_SESSION['modifid'] . '\'';
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    header('Location: get_translation.php');
    exit();

}
else if($action == 'Supprimer'){
    $query = 'DELETE FROM translation WHERE trad_id = \'' . $_POST['id'] . '\'';
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    header('Location: get_translation.php');
    exit();
}



?>