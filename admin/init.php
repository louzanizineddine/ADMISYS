<?php

include 'connect.php'; // include connect.php file
    // Routes
    $tpl = "includes/templates/"; // Template Directory
    $lang = "includes/languages/"; // Language Directory
    $func = "includes/functions/"; // Functions Directory

    include $func . 'functions.php';
    include $lang . 'english.php';
    include $tpl . 'header.php';

    // INCLUDE NAVBAR ON ONLY PAGES THAT HAVE NO $NO_NAVBAR VARIABLE
   if (!isset($Navbar)) { include $tpl . 'navbar.php'; }

