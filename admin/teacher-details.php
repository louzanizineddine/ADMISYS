<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Teacher Details';
    include 'init.php';
    $id = $_GET['teacher_id'];

    // Retrieve student details from the database
    $stmt = $connection->query("SELECT * FROM Enseignants WHERE id_enseignant = $id");
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <h2 class="text-center mt-5 mb-5"><?php echo lang("TEACHER-DETAILS") ?></h2>
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <img src="layout/images/bousla.png" style="height: 300px; width: 200px" class="img-fluid rounded" alt="Profile Picture">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $teacher['id_enseignant']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang("NAME") ?></th>
                        <td><?php echo $teacher['nom']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang("SURNAME") ?></th>
                        <td><?php echo $teacher['prenom']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $teacher['email']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang("SUBJECT") ?></th>
                        <td><?php echo $teacher['matiere_enseignee']; ?></td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="manage-teacher.php?action=edit&teacher_id=<?php echo $teacher['id_enseignant']; ?>" class="btn btn-primary">
                        Edit
                    </a>
                    <a href="manage-teacher.php?action=delete&teacher_id=<?php echo $teacher['id_enseignant']; ?>" class="btn btn-danger">
                        Delete
                    </a>
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