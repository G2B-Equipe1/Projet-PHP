<?php
include_once "util.php";
$dbLink = mysqli_connect("mysql-projet-php-g2b-equipe1.alwaysdata.net", "149737_user", "joyeuxnoel")
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

mysqli_select_db($dbLink , "projet-php-g2b-equipe1_database")
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
