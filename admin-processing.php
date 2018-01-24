<?php
session_start();
require ('base.php');
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
else
{
    echo 'Erreur : aucune action de type : ' . $action . ' dans le fichier admin_processing.php';
    exit();
}