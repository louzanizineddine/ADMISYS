<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

if (isset($_SESSION['username'])) {
    $pageTitle = 'Manage inscription';
    include 'init.php';

    //  Check if the get request id is numeric & get the integer value of it
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    // get the state from the get request
    $state = isset($_GET['state']) ? $_GET['state'] : 'default';

    if ($state == 'new') {
//        print_r($_GET);
        $stmt = $connection->prepare("SELECT * FROM Inscriptions WHERE id = ?");
        $stmt->execute(array($id));
        $inscription = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt_documents = $connection->prepare("SELECT * FROM Documents WHERE id_inscription = ?");
        $stmt_documents->execute(array($id));
        $documents = $stmt_documents->fetchAll();


        $stmt_docs = $connection->query("SELECT * FROM Documents where id_inscription = $id");
        $docs = $stmt_docs->fetchAll(PDO::FETCH_ASSOC);
//        print_r($documents);

?>

        <div class="container">
        <h2 class="mt-5">Inscription N:<?php echo $inscription['id']?></h2>
        <hr>
        <div class="row text-center m-3">
            <div class="col-md-12">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($inscription['photo']); ?>"
                     alt="student photo" width="300" height="300">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-success p-4">
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
                        <th><?php echo lang("BIRTHDATE") ?></th>
                        <td><?php echo $inscription['date_naissance']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $inscription['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $inscription['telephone']; ?></td>
                    </tr>
                    </tbody>
                </table>
                <div class="row mt-3 text-center">
                    <div class="col-md-6">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button class="btn btn-primary btn-lg p-3 m-3" type="submit" name="application-to-process"
                                    value="<?php echo $inscription['id']; ?>">
                                <i class="fa-solid fa-forward-step"></i> Consider
                            </button>
                        </form>

                    </div>
                    <div class="col-md-6">
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="application-to-reject">
                            <button class="btn btn-danger btn-lg p-3 m-3" type="submit" name="application-to-reject"
                                    value="<?php echo $inscription['id']; ?>">
                                <i class="fa-sharp fa-solid fa-xmark"></i> Reject
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="text-center mt-5 ">Documents</h2>
            <hr>
            <?php if (empty($docs)) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    No documents uploaded yet.
                </div>
            <?php } ?>
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
    }


    if ($state == 'in-process') {
        echo 'in process';
    }

    if ($state == 'accepted') {
        echo 'accepted';
    }

    if ($state == 'in-pause') {
        echo 'in pause';
    }

    if ($state == 'on-hold') {
        echo 'in pause';
    }

    if ($state == 'rejected') {
        echo 'rejected';
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
    // check if the ther is a post request from the form with name application-to-process
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application-to-process'])) {
        print_r($_POST);
        $stmt = $connection->prepare("UPDATE Inscriptions SET statut_demande = 'en cours de traitement' WHERE id = ?");
        $stmt->execute(array($_POST['application-to-process']));
        print_r($_POST);
        header('Location: inscriptions.php');
        exit();
    }
?>

<?php
// check if the ther is a post request from the form with name application-to-process
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application-to-reject'])) {
        print_r($_POST);
        $stmt = $connection->prepare("UPDATE Inscriptions SET statut_demande = 'refusee' WHERE id = ?");
        $stmt->execute(array($_POST['application-to-reject']));
        print_r($_POST);
        header('Location: inscriptions.php');
        exit();
    }
?>


