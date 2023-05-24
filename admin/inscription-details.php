<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'inscription Details';
    include 'init.php';
    $id = $_GET['id'];

    // Retrieve inscription details from the database
    $stmt = $connection->query("SELECT * FROM Inscriptions WHERE id = $id");
    $inscription = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <div class="container">
        <h2 class="text-center mt-5 mb-5"><?php echo lang("INSCRIPTION-DETAILS") ?></h2>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-success">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo $inscription['id']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("NAME") ?></th>
                            <td><?php echo $inscription['nom']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("SURNAME") ?></th>
                            <td><?php echo $inscription['prenom']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $inscription['email']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("PHONE") ?></th>
                            <td><?php echo $inscription['telephone']; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang("STATUS REGISTRATION") ?></th>
                            <td><?php echo $inscription['statut inscription']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="manage-inscription.php?action=edit&inscription_id=<?php echo $inscription['id']; ?>" class="btn btn-primary">
                        Edit
                    </a>
                    <a href="manage-inscription.php?action=delete&inscription_id=<?php echo $inscription['id']; ?>" class="btn btn-danger">
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
