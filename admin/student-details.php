<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Student Details';
    include 'init.php';
    $id = $_GET['student_id'];

    // Retrieve student details from the database
    $stmt = $connection->query("SELECT * FROM Etudiants WHERE id_etudiant = $id");
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <div class="container">
        <h2 class="text-center mt-5 mb-5"><?php echo lang("STUDENT-DETAILS") ?></h2>
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <img src="layout/images/pic.jpeg" class="img-fluid rounded" alt="Profile Picture">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo $student['id_etudiant']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("NAME") ?></th>
                            <td><?php echo $student['nom']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("SURNAME") ?></th>
                            <td><?php echo $student['prenom']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("BIRTHDATE") ?></th>
                            <td><?php echo $student['date_naissance']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("STUDENT-NUMBER") ?></th>
                            <td><?php echo $student['num_etudiant']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $student['email']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="edit_student.php?student_id=<?php echo $student['id_etudiant']; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete_student.php?student_id=<?php echo $student['id_etudiant']; ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
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