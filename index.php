<?php
include_once 'vues/util.php';
include_once 'vues/index.php';
session_start();

start_page();

nav_bar();

coaroussel();
body();

footer();
end_page();
?>

