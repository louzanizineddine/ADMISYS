<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle = 'Admin Panel';
    include 'init.php';

    // include the footer
    include $tpl . 'footer.php';
}else {
//    echo 'you are not authorized to view this page';
    header('Location: index.php');
    exit();
}
