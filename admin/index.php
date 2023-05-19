<?php
    session_start();
    $Navbar = '';
    $pageTitle = 'login';
    if (isset($_SESSION['username'])) {
        header('Location: admin-panel.php');
    }
    include 'init.php'; // include init.php file

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    // check if the request is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedpass = sha1($password);

//        echo  $username . ' ' . $password;
//        echo  $hashedpass;


        // we check if the user already exist in  db
        $stmt = $connection->prepare("SELECT id_admin , username , password from administrateurs where username = ? and password = ?");
        $stmt->execute(array($username, $hashedpass));
        $record= $stmt->fetch();
        $result_count = $stmt->rowCount();

        if ($result_count > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['id_admin'] = $record['id_admin'];
//            print_r($_SESSION);
            header('Location: admin-panel.php');
            exit();
        }
        else {
            echo 'user not found';
        }
    }

?>

    <form class="login" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <h3 class="text-center">Admin login</h3>
        <input class="form-control" type="text" placeholder="username" name="username" autocomplete="off" />
        <input class="form-control" type="password" placeholder="password" name="password" autocomplete="new-password" />
        <input class="btn btn-primary btn-block" type="submit" value="login" />
    </form>

<?php 

    include $tpl . 'footer.php';
?>


