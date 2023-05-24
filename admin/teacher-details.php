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
    $stmt = $connection->query("SELECT * FROM Enseignants WHERE id = $id");
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt_docs = $connection->query("SELECT * FROM Documents where id_enseignant = $id");
    $docs = $stmt_docs->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <h2 class="text-center mt-5 "><?php echo $teacher['nom']?>'s Details</h2>
        <hr>
        <div class="row text-center m-3">
            <div class="col-md-12">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($teacher['photo']); ?>"
                     alt="student photo" width="300" height="300">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-success">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $teacher['id']; ?></td>
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
                        <th>Birthday</th>
                        <td><?php echo $teacher['date_naissance']; ?></td>
                    </tr>
                    <tr>
                        <th>Born in</th>
                        <td><?php echo $teacher['lieu_naissance']; ?></td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td><?php echo $teacher['nationalite']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang("PHONE") ?></th>
                        <td><?php echo $teacher['telephone']; ?></td>
                    </tr>
                    <tr>
                        <th>Full address</th>
                        <td><?php echo $teacher['adresse']; ?></td>
                    </tr>
                    </tbody>
                </table>
                <div class="mt-3 text-center">
                    <a href="manage-teacher.php?action=edit&teacher_id=<?php echo $teacher['id']; ?>" class="btn btn-primary btn-lg p-3 m-3">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <a href="manage-teacher.php?action=delete&teacher_id=<?php echo $teacher['id']; ?>" class="btn btn-danger btn-lg p-3 m-3">
                        <i class="fa-sharp fa-solid fa-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>


    <div class="row">
        <h2 class="text-center mt-5 ">Documents</h2>
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