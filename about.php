<?php
session_start();
include_once 'vues/util.php';
include_once 'vues/about.php';
start_page();
nav_bar();

about_body();

end_page();
?>