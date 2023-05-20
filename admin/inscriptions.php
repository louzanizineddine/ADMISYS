<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['username'])) {
        $pageTitle = 'Inscriptions List';
        include 'init.php';
        $stmt = $connection->query("SELECT * FROM Inscriptions");
        $inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2 class="mt-5">Inscriptions List</h2>
    <?php
    // Check if the update is successful and show a notification
    if (isset($_SESSION['update_success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['update_success'] . '</div>';
        unset($_SESSION['update_success']); // Clear the success message from the session
    }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th><?php echo lang("NAME")?></th>
                <th><?php echo lang("SURNAME")?></th>
                <th><?php echo lang("EMAIL")?></th>
                <th><?php echo lang("PHONE")?></th>
                <th><?php echo lang("STATUS REGISTRATION")?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscriptions as $inscription) { ?>
                <tr>
                    <td><?php echo $inscription['id_inscription']; ?></td>
                    <td><?php echo $inscription['nom']; ?></td>
                    <td><?php echo $inscription['prenom']; ?></td>
                    <td><?php echo $inscription['email']; ?></td>
                    <td><?php echo $inscription['num_etudiant']; ?></td>
                    <td><?php echo $inscription['statut_inscription']; ?></td>
                    <td><a href="inscription-details.php?student_id=<?php echo $inscription['id_inscription']?>" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
        // include the footer
        include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
?>
