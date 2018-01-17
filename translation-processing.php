<?php
$from = $_GET['from'];
$to = $_GET['to'];
$to_translete = $_GET['to_translate'];

if ($from == 'Français' && $to == 'Anglais') {
    $query = null ;
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
// Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
// Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
}



