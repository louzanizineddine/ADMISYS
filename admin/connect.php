<?php

    $dsn= 'mysql:host=localhost;dbname=ADMISYS';
    $user= 'root';
    $pass= 'zineddine';

    $OPTIONS = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {
        $connection = new PDO($dsn, $user, $pass, $OPTIONS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        echo "ooooh connected";
    }
    catch (PDOException $e) {
        echo "Failed to connect" . $e->getMessage();
    }

