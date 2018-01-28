<?php
session_start();
include_once 'vues/util.php';
include_once 'vues/index.php';


start_page();

nav_bar();

caroussel();
body();

footer();
end_page();
?>

