<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'News Details';
    include 'init.php';
    // Retrieve the content from the Quill editor
//    if (isset($_POST['editorContent']){
        $content = file_get_contents("php://input");
        $content = json_decode($content, true);


        $stmt = $connection->prepare("UPDATE Nouveautes SET description = ? WHERE id= ?");
        $stmt->execute(array($content['editorContent'], $content['id']));
//        header('Location: news.php');
        $_SESSION['update_success'] = 'Update successful!';

//    };
    include $tpl . 'footer.php';
} else {
    echo 'You are not authorized to view this page.';
    header('Location: index.php');
    exit();
}

