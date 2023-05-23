<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle = 'Admin Panel';
    include 'init.php';
    if(isset($_POST['query'])) {
        $search = $_POST['query'];
        $stmt_students = $connection->prepare("SELECT * FROM Etudiants WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%'");
        $stmt_students->execute();
        $result_students = $stmt_students->fetchAll();
        $total_students_row = $stmt_students->rowCount();

        $stmt_teachers = $connection->prepare("SELECT * FROM Enseignants WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%'");
        $stmt_teachers->execute();
        $result_teachers = $stmt_teachers->fetchAll();
        $total_teachers_row = $stmt_teachers->rowCount();

        $stmt_news = $connection->prepare("SELECT * FROM Nouveautes WHERE titre LIKE '%$search%' OR description LIKE '%$search%'");
        $stmt_news->execute();
        $result_news = $stmt_news->fetchAll();
        $total_news_row = $stmt_news->rowCount();
        


        print_r($result_students);
        print_r($result_teachers);
        print_r($result_news);
    }
    // include the footer
    include $tpl . 'footer.php';
}else {
//    echo 'you are not authorized to view this page';
    header('Location: index.php');
    exit();
}
