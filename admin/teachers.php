<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle = 'Students List';
    include 'init.php';
    $stmt = $connection->query("SELECT * FROM Enseignants");
    $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        print_r($teachers);
?>

    <div class="container">
        <h2 class="mt-5">Teachers List</h2>
        <hr>
        <?php
        // Check if the update is successful and show a notification
        if (isset($_SESSION['update_success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['update_success'] . '</div>';
            unset($_SESSION['update_success']); // Clear the success message from the session
        }
        ?>
        <table class="table table-success table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo lang("NAME")?></th>
                <th><?php echo lang("SURNAME")?></th>
                <th><?php echo lang("EMAIL")?></th>
                <th><?php echo lang("ACTION")?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($teachers as $teacher) { ?>
                <tr>
                    <td><?php echo $teacher['id']; ?></td>
                    <td><?php echo $teacher['nom']; ?></td>
                    <td><?php echo $teacher['prenom']; ?></td>
                    <td><?php echo $teacher['email']; ?></td>
                    <td><a href="teacher-details.php?teacher_id=<?php echo $teacher['id']?>" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
    // include the footer
    include $tpl . 'footer.php';
}
else {
    header('Location: index.php');
    exit();
}

?>


