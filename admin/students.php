<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
        if (isset($_SESSION['username'])) {
        $pageTitle = 'Students List';
        include 'init.php';
        $stmt = $connection->query("SELECT * FROM Etudiants");
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

//        print_r($students);
?>

            <div class="container">
                <h2 class="mt-5">Students List</h2>
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
                        <th><?php echo lang("BIRTHDATE")?></th>
                        <th><?php echo lang("STUDENT-NUMBER")?></th>
                        <th><?php echo lang("EMAIL")?></th>
                        <th>More info</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student) { ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['nom']; ?></td>
                            <td><?php echo $student['prenom']; ?></td>
                            <td><?php echo $student['date_naissance']; ?></td>
                            <td><?php echo $student['num_etudiant']; ?></td>
                            <td><?php echo $student['email']; ?></td>
                            <td><a href="student-details.php?student_id=<?php echo $student['id']?>" class="btn btn-success"><i class="fa-solid fa-info"></i></a></td>
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


