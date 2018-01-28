<?php
if(isset($_COOKIE['confirmail']))
{
    header('Location : activate.php');
}
include_once 'vues/util.php';
include_once 'modeles/base.php';
include_once 'vues/user_space.php';
session_start();
start_page();
nav_bar();
if(!isset($_SESSION['mail'])) {
    connexion();
}
else {
    user_information_and_actions();
}

end_page();
