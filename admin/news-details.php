<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'News Details';
    include 'init.php';
    $id = $_GET['id'];

    // Retrieve student details from the database
    $stmt = $connection->query("SELECT * FROM Nouveautes WHERE id = $id");
    $news= $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">

        <div class="article mt-5 p-4 bg-light border shadow">
            <h2 class="article-title mt-5 mb-5"><?php echo $news['titre']?></h2>
            <p class="article-description db-text"><?php echo $news['description']?></p>
            <p class="article-date text-success"><?php echo date("F j, Y", strtotime($news['date'])); ?></p>
        </div>
        <div class="mt-3 text-center">
                <a href="manage-news.php?action=edit&id=<?php echo $news['id']?>" class="btn btn-primary">Edit</a>
                <a href="manage-news.php?action=delete&id=<?php echo $news['id']?>" class="btn btn-danger">Delete</a
        </div>





    </div>

    <?php
    // Include the footer
    include $tpl . 'footer.php';
} else {
    echo 'You are not authorized to view this page.';
    header('Location: index.php');
    exit();
}
?>
