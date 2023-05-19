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
    $stmt = $connection->prepare("SELECT * FROM Etudiants WHERE id_etudiant = ?");
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
            <form action="update_student.php" method="POST" class="mt-4 border border-2 rounded border-primary p-4 bg-light">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="first_name" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="name" value="<?php  echo $student['nom']; ?>">
                            <button class="btn btn-primary" type="button">Update</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="surname" class="form-label">Surname</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="first_name" name="surname" value="<?php  echo $student['prenom']; ?>">
                            <button class="btn btn-primary" type="button">Update</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="birthdate" class="form-label">birthdate</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="birth-date" name="birthdate" value="<?php  echo $student['date_naissance']; ?>">
                            <button class="btn btn-primary" type="button">Update</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value="<?php  echo $student['email']; ?>">
                            <button class="btn btn-primary" type="button">Update</button>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['action'] == 'delete') {
        $student_id = $_GET['student_id'];
        $stmt = $connection->prepare("DELETE FROM Etudiants WHERE id_etudiant = ?");
        $stmt->execute(array($student_id));
        header('Location: students.php');
        ob_end_flush();
    }
?>

