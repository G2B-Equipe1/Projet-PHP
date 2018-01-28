<?php
session_start();
include('modeles/base.php');
if(!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' )
{

    header('Location: user_space.php');
    exit();
}
if(isset($_POST['mail']))
{
    if(isset($_POST['standard'])) $cat = $_POST['standard'];
    else if(isset($_POST['premium'])) $cat = $_POST['premium'];
    else if(isset($_POST['traducteur'])) $cat = $_POST['traducteur'];
    else if(isset($_POST['administrateur'])) $cat = $_POST['administrateur'];

    $_POST['mail'] = mysqli_real_escape_string($dbLink, $_POST['mail']);

    $query = 'UPDATE user SET categorie = \'' . $cat .
        '\' WHERE email = \'' . $_POST['mail'] . '\'';
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    header('Location: admin.php');
    exit();
}
else if (isset($_POST['new']) && !empty($_POST['new']) && isset($_POST['fr']) && !empty($_POST['fr']) && isset($_POST['en']) && !empty($_POST['en'])){
    $today = date('Y-m-d');
    $query = 'INSERT INTO translation (user_id, word, translation, date, lang ) 
                      VALUES (\'' . $_SESSION['id'] . '\', \'' . $_POST['en'] . '\', \''
        . $_POST['fr'] . '\', \'' . $today . '\', \'french\' )';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }

    $query = 'INSERT INTO translation (user_id, word, translation, date, lang ) 
                      VALUES (\'' . $_SESSION['id'] . '\', \'' . $_POST['en'] . '\', \''
        . $_POST['new'] . '\', \'' . $today . '\', \'' . $_POST['en'] .'\' )';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    header('Location: admin.php');
    exit();
}
else
{
    echo 'Erreur : aucune action de type : ' . $action . ' dans le fichier admin_processing.php';
    exit();
}