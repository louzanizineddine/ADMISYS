<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'News List';
    include 'init.php';
    // fetch all news from the database
    $stmt = $connection->query("SELECT * FROM Nouveautes");
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    print_r($news);
    ?>
    <div class="container">
        <h2 class="mt-5">News Management</h2>
        <hr>
        <!-- Add news form -->
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add-news">Add News</button>
        </form>

        <hr>
        <!-- News list -->


        <?php foreach ($news as $new) { ?>
            <div class="card mb-5 shadow">
                <div class="card-header">
                    <h3 class="text-success"><?php echo $new['id']; ?></h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $new['titre']; ?></h5>
                    <p class="card-text"><?php echo substr($new['description'], 0, 200) ?>...</p>
                    <a href="news-details.php?id=<?php echo $new['id']?>" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer">
                    <?php echo date("F j, Y", strtotime($new['date'])); ?>
                </div>
            </div>

        <?php } ?>

    </div>

    <?php

    // include the footer
    include $tpl . 'footer.php';
}
else {
    header('Location: index.php');
    exit();
}
?>

<?php
    // add news article to the database
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-news'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $connection->prepare("INSERT INTO Nouveautes (titre, description) VALUES (?, ?)");
        $stmt->execute(array($title, $content));
        header('Location: news.php');
        ob_end_flush();
    }
?>
