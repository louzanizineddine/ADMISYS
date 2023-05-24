<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['username'])) {
        $pageTitle = 'Inscriptions List';
        include 'init.php';
        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'envoyee'");
        $new_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'en cours de traitement'");
        $in_process_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'en pause'");
        $in_pause_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'refusee'");
        $rejected_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'en attente'");
        $on_hold_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connection->query("SELECT * FROM Inscriptions WHERE statut_demande = 'acceptee'");
        $accpeted_inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2 class="mt-5">Inscriptions List</h2>
    <hr>
    <?php
    // Check if the update is successful and show a notification
    if (isset($_SESSION['update_success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['update_success'] . '</div>';
        unset($_SESSION['update_success']); // Clear the success message from the session
    }
    ?>
    <h1 class="mt-5">New Applications</h1>
    <?php if (empty($new_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no new applications</div>
    <?php } ?>

    <?php if (!empty($new_inscriptions)) { ?>
        <table class="table table-primary shadow">
        <thead>
            <tr>
                <th>ID</th>
                <th><?php echo lang("NAME")?></th>
                <th><?php echo lang("SURNAME")?></th>
                <th><?php echo lang("EMAIL")?></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($new_inscriptions as $inscription) { ?>
                <tr>
                    <td><?php echo $inscription['id']; ?></td>
                    <td><?php echo $inscription['nom']; ?></td>
                    <td><?php echo $inscription['prenom']; ?></td>
                    <td><?php echo $inscription['email']; ?></td>
                    <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&state=new" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <h1 class="mt-5">In process Applications</h1>

    <?php if (empty($in_process_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no in process applications</div>
    <?php } ?>

    <?php if (!empty($in_process_inscriptions)) { ?>
        <table class="table table-info shadow ">
        <thead>
        <tr>
            <th>ID</th>
            <th><?php echo lang("NAME")?></th>
            <th><?php echo lang("SURNAME")?></th>
            <th><?php echo lang("EMAIL")?></th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($in_process_inscriptions as $inscription) { ?>
            <tr>
                <td><?php echo $inscription['id']; ?></td>
                <td><?php echo $inscription['nom']; ?></td>
                <td><?php echo $inscription['prenom']; ?></td>
                <td><?php echo $inscription['email']; ?></td>
                <!--                    <td>--><?php //echo $inscription['num_etudiant']; ?><!--</td>-->
                <!--                    <td>--><?php //echo $inscription['statut_inscription']; ?><!--</td>-->
                <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&state=in-process" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <h1 class="mt-5">Accepted Applications</h1>
    <?php if (empty($accpeted_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no in process applications</div>
    <?php } ?>

    <?php if (!empty($accpeted_inscriptions)) { ?>
        <table class="table table-success shadow">
        <thead>
        <tr>
            <th>ID</th>
            <th><?php echo lang("NAME")?></th>
            <th><?php echo lang("SURNAME")?></th>
            <th><?php echo lang("EMAIL")?></th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($accpeted_inscriptions as $inscription) { ?>
            <tr>
                <td><?php echo $inscription['id']; ?></td>
                <td><?php echo $inscription['nom']; ?></td>
                <td><?php echo $inscription['prenom']; ?></td>
                <td><?php echo $inscription['email']; ?></td>
                <!--                    <td>--><?php //echo $inscription['num_etudiant']; ?><!--</td>-->
                <!--                    <td>--><?php //echo $inscription['statut_inscription']; ?><!--</td>-->
                <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&state=accepted" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } ?>


    <h1 class="mt-5">In pause Applications</h1>
    <?php if (empty($in_pause_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no in pause applications</div>
    <?php } ?>
    <?php if (!empty($in_pause_inscriptions)) { ?>
    <table class="table table-light shadow">
        <thead>
        <tr>
            <th>ID</th>
            <th><?php echo lang("NAME")?></th>
            <th><?php echo lang("SURNAME")?></th>
            <th><?php echo lang("EMAIL")?></th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($in_pause_inscriptions as $inscription) { ?>
            <tr>
                <td><?php echo $inscription['id']; ?></td>
                <td><?php echo $inscription['nom']; ?></td>
                <td><?php echo $inscription['prenom']; ?></td>
                <td><?php echo $inscription['email']; ?></td>
                <!--                    <td>--><?php //echo $inscription['num_etudiant']; ?><!--</td>-->
                <!--                    <td>--><?php //echo $inscription['statut_inscription']; ?><!--</td>-->
                <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&sate=in-pause" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <h1 class="mt-5">Rejected Applications</h1>
    <?php if (empty($rejected_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no in pause applications</div>
    <?php } ?>
    <?php if (!empty($rejected_inscriptions)) { ?>
    <table class="table table-danger shadow">
        <thead>
        <tr>
            <th>ID</th>
            <th><?php echo lang("NAME")?></th>
            <th><?php echo lang("SURNAME")?></th>
            <th><?php echo lang("EMAIL")?></th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rejected_inscriptions as $inscription) { ?>
            <tr>
                <td><?php echo $inscription['id']; ?></td>
                <td><?php echo $inscription['nom']; ?></td>
                <td><?php echo $inscription['prenom']; ?></td>
                <td><?php echo $inscription['email']; ?></td>
                <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&state=rejected" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <h1 class="mt-5">On hold Applications</h1>
    <?php if (empty($on_hold_inscriptions)) { ?>
        <div class="alert alert-danger text-center">There is no in pause applications</div>
    <?php } ?>
    <?php if (!empty($on_hold_inscriptions)) { ?>
        <table class="table table-warning shadow">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo lang("NAME")?></th>
                <th><?php echo lang("SURNAME")?></th>
                <th><?php echo lang("EMAIL")?></th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($on_hold_inscriptions as $inscription) { ?>
                <tr>
                    <td><?php echo $inscription['id']; ?></td>
                    <td><?php echo $inscription['nom']; ?></td>
                    <td><?php echo $inscription['prenom']; ?></td>
                    <td><?php echo $inscription['email']; ?></td>
                    <td><a href="manage-inscription.php?id=<?php echo $inscription['id']?>&state=on-hold" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>



</div>

<?php
        // include the footer
        include $tpl . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
?>
