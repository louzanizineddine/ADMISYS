<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle = 'Documents';
    include 'init.php';
    // get the id from the url
    $id = isset($_GET['document_id']) && is_numeric($_GET['document_id']) ? intval($_GET['document_id']) : 0;
    // make a query to retrieve the document from the database
    $stmt = $connection->prepare("SELECT * FROM Documents WHERE id = ?");
    $stmt->execute(array($id));
    $document = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdfData = $document['data'];
    $pdfDataEncoded = base64_encode($pdfData);
    $pdfDataUri = 'data:application/pdf;base64,' . $pdfDataEncoded;
//    print_r($document);

    // create the html to show the document

    ?>
    <div class="container">
        <h2 class="text-center mt-5 "><?php echo $document['nom'] ?></h2>
        <hr>
        <div>
        <embed src="<?php echo $pdfDataUri; ?>" type="application/pdf" width="100%" height="800px">

        </div>
    </div>


    <?php

    // include the footer
    include $tpl . 'footer.php';
}else {
//    echo 'you are not authorized to view this page';
    header('Location: index.php');
    exit();
}
