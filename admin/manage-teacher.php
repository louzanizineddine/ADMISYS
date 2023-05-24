<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Teacher Details';
    include 'init.php';
//    print_r($_GET);

    $teacher_id = isset($_GET['teacher_id']) && is_numeric($_GET['teacher_id']) ? intval($_GET['teacher_id']) : 0;
    $stmt = $connection->prepare("SELECT * FROM Enseignants WHERE id = ?");
    $stmt->execute(array($teacher_id));
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
//    print_r($student);

    // handle the action DELETE

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        ?>
        <div class="container">
            <h2 class="text-center mt-5">Delete Student</h2>
            <div class="row text-center">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="delete-from">
                    <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">
                    <p class="bold">Are you sure you want to delete this teacher?</p>
                    <button type="submit" class="btn btn-lg btn-danger">
                        <i class="fa fa-trash"></i> Delete</button>
                    <a href="teachers.php" class="btn btn-lg btn-secondary">
                        <i class="fa-sharp fa-solid fa-xmark"></i> Cancel</a>
                </form>
            </div>
        </div>
        <?php
    }

    // handle the action EDIT
    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
        ?>

        <div class="container">
            <h2 class="text-center mt-5">Update <?php echo $teacher['nom']?>'s Informations</h2>
            <hr>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="first_name" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="name" value="<?php  echo $teacher['nom']; ?>">
                            <button class="btn btn-primary" name="update-teacher-name" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="surname" class="form-label">Surname</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="surname" value="<?php  echo $teacher['prenom']; ?>">
                            <button class="btn btn-primary" name="update-teacher-surname" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value="<?php  echo $teacher['email']; ?>">
                            <button class="btn btn-primary" name="update-teacher-email"  type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="phone-number" class="form-label">phone number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="phone-number" name="phone-number" value="<?php  echo $teacher['telephone']; ?>">
                        <button class="btn btn-primary" name="update-phone-number" type="submit">Update</button>
                    </div>
                </div>
            </div>
            </form>


            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="birthdate" class="form-label">birthdate</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="birth-date" name="birthdate" value="<?php  echo $teacher['date_naissance']; ?>">
                            <button class="btn btn-primary" name="update-birthdate" type="submit">Update</button>
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
?>


<?php
// HANDLE THE DELETE ACTION
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['action'] == 'delete') {
    $teacher_id = $_GET['teacher_id'];
    $stmt = $connection->prepare("DELETE FROM Enseignants WHERE id_enseignant= ?");
    $stmt->execute(array($teacher_id));
    $_SESSION['update_success'] = 'Update successful!';
    header('Location: teachers.php');
    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-teacher-name'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher_name = $_POST['name'];
    $stmt = $connection->prepare("UPDATE Enseignants SET nom = ? WHERE id_enseignant = ?");
    $stmt->execute(array($teacher_name, $teacher_id));
    header('Location: teachers.php');
    $_SESSION['update_success'] = 'Update successful!';

    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-teacher-surname'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher_surname = $_POST['surname'];
    $stmt = $connection->prepare("UPDATE Enseignants SET prenom = ? WHERE id = ?");
    $stmt->execute(array($teacher_surname, $teacher_id));
    header('Location: teachers.php');
    $_SESSION['update_success'] = 'Update successful!';

    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-birthdate'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher_birthdate = $_POST['birthdate'];
    $stmt = $connection->prepare("UPDATE Enseignants SET date_naissance = ? WHERE id = ?");
    $stmt->execute(array($teacher_birthdate, $teacher_id));
    header('Location: teachers.php');
    $_SESSION['update_success'] = 'Update successful!';

    ob_end_flush();
}
?>

<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-teacher-email'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher_email = $_POST['email'];
    $stmt = $connection->prepare("UPDATE Enseignants SET email = ? WHERE id= ?");
    $stmt->execute(array($teacher_email, $teacher_id));
    header('Location: teachers.php');
    $_SESSION['update_success'] = 'Update successful!';
    ob_end_flush();
}
?>


<?php
// HANDLE THE UPDATE ACTION

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-phone-number'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher_number = $_POST['phone-number'];
    $stmt = $connection->prepare("UPDATE Enseignants SET telephone = ? WHERE id= ?");
    $stmt->execute(array($teacher_number, $teacher_id));
    header('Location: teachers.php');
    $_SESSION['update_success'] = 'Update successful!';
    ob_end_flush();
}
?>




