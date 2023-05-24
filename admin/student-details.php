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
    $stmt = $connection->query("SELECT * FROM Etudiants WHERE id = $id");
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt_docs = $connection->query("SELECT * FROM Documents where id_etudiant = $id");
    $docs = $stmt_docs->fetchAll(PDO::FETCH_ASSOC);
//    print_r($docs);
//
    ?>

    <div class="container">
        <h2 class="mt-5"><?php echo $student['nom']?>'s Details</h2>
        <hr>
        <div class="row text-center m-3">
            <div class="col-md-12">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($student['photo']); ?>"
                     alt="student photo" width="300" height="300">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-success p-4">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo $student['id']; ?></td>
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
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $student['telephone']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 text-center">
                    <a href="manage-student.php?action=edit&student_id=<?php echo $student['id']; ?>" class="btn btn-primary btn-lg p-3 m-3">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <a href="manage-student.php?action=delete&student_id=<?php echo $student['id']; ?>" class="btn btn-danger btn-lg p-3 m-3">
                        <i class="fa-sharp fa-solid fa-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="text-center mt-5 ">Documents</h2>
            <?php if (empty($docs)) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    No documents uploaded yet.
                </div>
            <?php } ?>
            <hr>
            <?php foreach ($docs as $doc) { ?>
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header"><h3><?php echo $doc['nom']?></h3></div>
                <div class="card-body">
                    <h5>type of document <?php echo $doc['mimetype']?></h5>
                    <h6>uploaded on <?php echo $doc['date']?></h6>
                    <a href="documents.php?document_id=<?php echo $doc['id']?> " target="_blank" class="btn bg-white p-2">Open</a>
                </div>
            <?php } ?>
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