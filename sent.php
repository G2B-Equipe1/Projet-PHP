<?php
/**
 * Created by PhpStorm.
 * User: c15013299
 * Date: 24/01/18
 * Time: 16:43
 */

include 'util.php';
start_page();
nav_bar();


$ameliorer= $_POST['ameliorer'];
$email= $_POST[$Mail];
$envoieMAil = mail($email , 'Problème lié avec le site virtuo linguo', $ameliorer);
echo $ameliorer

?>