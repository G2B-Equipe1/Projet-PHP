<?php
include_once 'vues/util.php';
include_once 'vues/index.php';
session_start();

start_page();

nav_bar();

caroussel();
body();

footer();
end_page();
?>

