<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Student Details';
    include 'init.php';
//    print_r($_GET);

    $student_id = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;
    $stmt = $connection->prepare("SELECT * FROM Etudiants WHERE id = ?");
    $stmt->execute(array($student_id));
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
//    print_r($student);

    // handle the action DELETE

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        ?>
        <div class="container">
            <h2 class="text-center mt-5">Delete Student</h2>
            <div class="row text-center">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="delete-from">
                    <input type="hidden" name="student_id" value="<?php echo $student['id_etudiant']; ?>">
                    <p class="bold">Are you sure you want to delete this student?</p>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="students.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
        <?php
    }

    // handle the action EDIT
    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
        ?>

        <div class="container">
            <h2 class="text-center mt-5">Update Student Information</h2>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="first_name" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="name" value="<?php  echo $student['nom']; ?>">
                            <button class="btn btn-primary" name="update-student-name" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="surname" class="form-label">Surname</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="surname" value="<?php  echo $student['prenom']; ?>">
                            <button class="btn btn-primary" name="update-student-surname" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="student-number" class="form-label">Student Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="student-number" name="student-number" value="<?php  echo $student['num_etudiant']; ?>">
                            <button class="btn btn-primary" name="update-student-number" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>


            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="phone-number" class="form-label">phone number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="phone-number" name="phone-number" value="<?php  echo $student['telephone']; ?>">
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
                            <input type="date" class="form-control" id="birth-date" name="birthdate" value="<?php  echo $student['date_naissance']; ?>">
                            <button class="btn btn-primary" name="update-student-birthdate" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value="<?php  echo $student['email']; ?>">
                            <button class="btn btn-primary" name="update-student-email"  type="submit">Update</button>
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
        $student_id = $_GET['student_id'];
        $stmt = $connection->prepare("DELETE FROM Etudiants WHERE id = ?");
        $stmt->execute(array($student_id));
        $_SESSION['update_success'] = 'Update successful!';
        header('Location: students.php');
        ob_end_flush();
    }
?>

<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-student-name'])) {
        $student_id = $_GET['student_id'];
        $student_name = $_POST['name'];
        $stmt = $connection->prepare("UPDATE Etudiants SET nom = ? WHERE id = ?");
        $stmt->execute(array($student_name, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';

        ob_end_flush();
    }
?>

<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-student-surname'])) {
        $student_id = $_GET['student_id'];
        $student_surname = $_POST['surname'];
        $stmt = $connection->prepare("UPDATE Etudiants SET prenom = ? WHERE id = ?");
        $stmt->execute(array($student_surname, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';

        ob_end_flush();
    }
?>

<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-student-birthdate'])) {
        $student_id = $_GET['student_id'];
        $student_birthdate = $_POST['birthdate'];
        $stmt = $connection->prepare("UPDATE Etudiants SET date_naissance = ? WHERE id  = ?");
        $stmt->execute(array($student_birthdate, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';

        ob_end_flush();
    }
?>

<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-student-email'])) {
        $student_id = $_GET['student_id'];
        $student_email = $_POST['email'];
        $stmt = $connection->prepare("UPDATE Etudiants SET email = ? WHERE id  = ?");
        $stmt->execute(array($student_email, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';
        ob_end_flush();
    }
?>

















<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-student-number'])) {
        $student_id = $_GET['student_id'];
        $student_number= $_POST['student-number'];
        $stmt = $connection->prepare("UPDATE Etudiants SET num_etudiant = ? WHERE id  = ?");
        $stmt->execute(array($student_number, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';

        ob_end_flush();
    }
?>

<?php
// HANDLE THE UPDATE ACTION

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-phone-number'])) {
        $student_id = $_GET['student_id'];
        $student_phone_number = $_POST['phone-number'];
        $stmt = $connection->prepare("UPDATE Etudiants SET telephone = ? WHERE id  = ?");
        $stmt->execute(array($student_phone_number, $student_id));
        header('Location: students.php');
        $_SESSION['update_success'] = 'Update successful!';
        ob_end_flush();
    }
?>



