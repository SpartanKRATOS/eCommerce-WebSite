<?php

session_start();

// Include functions and connect to the database using PDO MySQL
include 'php/functions.php';
$pdo = pdo_connect_mysql();
// Get the 4 most recently added products

// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';
?>

