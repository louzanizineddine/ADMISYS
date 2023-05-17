<?php

include 'connect.php'; // include connect.php file
    // Routes
    $tpl = "includes/templates/"; // Template Directory
    $lang = "includes/languages/"; // Language Directory
    $func = "includes/functions/"; // Functions Directory

    include $lang . 'english.php';
    include $tpl . 'header.php';

   if (!isset($Navbar)) {
       include $tpl . 'navbar.php';
   }

