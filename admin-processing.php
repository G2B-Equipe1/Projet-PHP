<?php
session_start();
include('modeles/base.php');
if(!isset($_SESSION['categorie']) || $_SESSION['categorie'] != 'Admin' ) {
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
        echo _('Erreur dans requête') .'<br />';
        // Affiche le type d'erreur.
        echo _('Erreur : ') . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo _('Requête : ') . $query . '<br/>';
        exit();
    }
    header('Location: admin.php');
    exit();
}
else
{
    echo _('Erreur : aucune action de type : ') . $action . _(' dans le fichier admin_processing.php');
    exit();
}