<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Manage inscription';
    include 'init.php';

    // handle the action DELETE
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id_inscription = $_GET['id_inscription'];
        $stmt = $connection->prepare("DELETE FROM Inscriptions WHERE id_inscription = ?");
        $stmt->execute(array($inscription_id));
        $_SESSION['update_success'] = 'inscription deleted successfully!';
        header('Location: inscriptions.php');
        ob_end_flush();
        exit();
    }

    // handle the action EDIT
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $id_inscription = $_GET['id_inscription'];
        $stmt = $connection->prepare("SELECT * FROM Inscriptions WHERE id_inscription = ?");
        $stmt->execute(array($inscription_id));
        $inscription = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$inscription) {
            echo 'inscription not found.';
            exit();
        }
?>

        <div class="container">
            <h2 class="text-center mt-5">Update inscription Information</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $inscription['name']; ?>">
                            <button class="btn btn-primary" name="update-inscription-name" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $inscription['email']; ?>">
                            <button class="btn btn-primary" name="update-inscription-email" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="phone" class="form-label">Phone</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $inscription['phone']; ?>">
                            <button class="btn btn-primary" name="update-inscription-phone" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="course" class="form-label">Course</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="course
                            " name="course" value="<?php echo $inscription['course']; ?>">
                            <button class="btn btn-primary" name="update-inscription-course" type="submit">Update</button>
                        </div>
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

// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_inscription = $_GET['id_inscription'];

    if (isset($_POST['update-inscription-name'])) {
        $name = $_POST['name'];
        $stmt = $connection->prepare("UPDATE inscriptions SET name = ? WHERE id = ?");
        $stmt->execute(array($name, $inscription_id));
        $_SESSION['update_success'] = 'Name updated successfully!';
        header('Location: inscriptions.php');
        ob_end_flush();
        exit();
    }

    if (isset($_POST['update-inscription-email'])) {
        $email = $_POST['email'];
        $stmt = $connection->prepare("UPDATE inscriptions SET email = ? WHERE id = ?");
        $stmt->execute(array($email, $inscription_id));
        $_SESSION['update_success'] = 'Email updated successfully!';
        header('Location: inscriptions.php');
        ob_end_flush();
        exit();
    }

    if (isset($_POST['update-inscription-phone'])) {
        $phone = $_POST['phone'];
        $stmt = $connection->prepare("UPDATE inscriptions SET phone = ? WHERE id = ?");
        $stmt->execute(array($phone, $inscription_id));
        $_SESSION['update_success'] = 'Phone updated successfully!';
        header('Location: inscriptions.php');
        ob_end_flush();
        exit();
    }

    if (isset($_POST['update-inscription-course'])) {
        $course = $_POST['course'];
        $stmt = $connection->prepare("UPDATE inscriptions SET course = ? WHERE id = ?");
        $stmt->execute(array($course, $inscription_id));
        $_SESSION['update_success'] = 'Course updated successfully!';
        header('Location: inscriptions.php');
        ob_end_flush();
        exit();
    }
}
?>
