<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Teacher Details';
    include 'init.php';
    print_r($_GET);

    $news_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $connection->prepare("SELECT * FROM Nouveautes WHERE id = ?");
    $stmt->execute(array($news_id));
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
//    print_r($student);

    // handle the action DELETE

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        ?>
        <div class="container">
            <h2 class="text-center mt-5">Delete Student</h2>
            <div class="row text-center">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="delete-from">
                    <input type="hidden" name="student_id" value="<?php echo $news['id']; ?>">
                    <p class="bold">Are you sure you want to delete this article?</p>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="news.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
        <?php
    }

    // handle the action EDIT
    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
        ?>

        <div class="container">
            <h2 class="text-center mt-5">Update Article Information</h2>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label">title</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="title" name="title" value="<?php  echo $news['titre']; ?>">
                            <button class="btn btn-primary" name="update-article-title" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="description" class="form-label">description</label>

                            <div id="editor"></div>
                            <button class="btn btn-primary" id="update-article-content" name="update-article-description" type="submit">Update</button>
                    </div>
                </div>
            </form>

        </div>




        <?php
    }

    // Include the footer
    include $tpl . 'footer.php';
} else {
    echo 'You are not authorized to view this page.';
    header('Location: index.php');
    exit();
}
?>


<?php
// HANDLE THE DELETE ACTION
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['action'] == 'delete') {
    $teacher_id = $_GET['id'];
    $stmt = $connection->prepare("DELETE FROM Nouveautes WHERE id= ?");
    $stmt->execute(array($teacher_id));
    $_SESSION['update_success'] = 'Update successful!';
    header('Location: news.php');
    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-article-title'])) {
    $news_id = $_GET['id'];
    $new_title = $_POST['title'];
    $stmt = $connection->prepare("UPDATE Nouveautes SET titre = ? WHERE id= ?");
    $stmt->execute(array($new_title, $news_id));
    header('Location: news.php');
    $_SESSION['update_success'] = 'Update successful!';

    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-article-description'])) {
    $news_id = $_GET['id'];
    $new_title = $_POST['description'];
    $stmt = $connection->prepare("UPDATE Nouveautes SET description = ? WHERE id= ?");
    $stmt->execute(array($new_title, $news_id));
    header('Location: news.php');
    $_SESSION['update_success'] = 'Update successful!';

    ob_end_flush();
}
?>







