<?php


include_once 'vues/util.php';
start_page();
nav_bar();


$ameliorer= $_POST['ameliorer'];
$email= $_POST['mail'];
$envoieMAil = mail($email , 'Probleme lie avec le site virtuo linguo', $ameliorer);
echo $ameliorer;

header("Location: about.php");

?>