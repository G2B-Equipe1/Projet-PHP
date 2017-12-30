<?php
include "utils.inc.php";
start_page('base');

$dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

$query = 'SELECT id, email FROM user';
if(!($dbResult = mysqli_query($dbLink, $query))) {
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $query . '<br/>';
    exit();
}

echo 'test <br/>';

while($dbRow = mysqli_fetch_assoc($dbResult)) {
    echo $dbRow['id'] . '<br/>';
    echo $dbRow['email'] . '<br/>';
    echo $dbRow['date'] . '<br/>';
    echo '<br/><br/>';
}

end_page();

