<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
        if (isset($_SESSION['username'])) {
        $pageTitle = 'Edit Profile';
        include 'init.php';
?>
            <div class="container">
                <h2 class="mt-5"><?php echo lang("EDIT-PROFILE") ?></h2>
                <div class="col-md-8">
                    <form class="edit-profile-admin mb-3" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="username" class="form-label"><?php echo lang("USERNAME") ?></label>
                            <input class="form-control form-control-lg" type="text" id="username" placeholder="<?php echo lang("USERNAME") ?>" name="username" autocomplete="off" />
                            <button class="btn btn-primary mt-2" type="submit" name="saveUsername" ><?php echo lang("UPDATE") ?></button>
                        </div>
                    </form>
                    <form class="edit-profile-admin mb-3" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="name" class="form-label"><?php echo lang("NAME") ?></label>
                            <input class="form-control form-control-lg" type="text" id="name" placeholder="<?php echo lang("NAME") ?>" name="name" autocomplete="off" />
                            <button class="btn btn-primary mt-2" type="submit" name="saveName"><?php echo lang("UPDATE") ?></button>
                        </div>
                    </form>
                    <form class="edit-profile-admin mb-3" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="surname" class="form-label"><?php echo lang("SURNAME") ?></label>
                            <input class="form-control form-control-lg" type="text" id="surname" placeholder="<?php echo lang("SURNAME") ?>" name="surname" autocomplete="off" />
                            <button class="btn btn-primary mt-2" type="submit" name="saveSurname"><?php echo lang("UPDATE") ?></button>
                        </div>
                    </form>
                    <form class="edit-profile-admin mb-3" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="email" class="form-label"><?php echo lang("EMAIL") ?></label>
                            <input class="form-control form-control-lg" type="email" id="email" placeholder="<?php echo lang("EMAIL") ?>" name="email" autocomplete="off" />
                            <button class="btn btn-primary mt-2" type="submit" name="saveEmail"><?php echo lang("UPDATE") ?></button>
                        </div>
                    </form>
                    <form class="edit-profile-admin mb-3" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="form-group">
                            <label for="password" class="form-label"><?php echo lang("PASSWORD") ?></label>
                            <input class="form-control form-control-lg" type="password" id="password" placeholder="<?php echo lang("PASSWORD") ?>" name="password" autocomplete="new-password" />
                            <button class="btn btn-primary mt-2" type="submit" name="savePassword"><?php echo lang("UPDATE") ?></button>
                        </div>
                    </form>
                </div>
            </div>


            <?php

        // include the footer
        include $tpl . 'footer.php';
    } else {
    //    echo 'you are not authorized to view this page';
        header('Location: index.php');
        exit();
        } ?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["saveUsername"])) {
        echo 'asled for username update';
        // Handle username update
        $newUsername = $_POST["username"];
        $stmt = $connection->prepare("UPDATE administrateurs SET username = ? WHERE id_admin = ?");
        $stmt->execute(array($newUsername, $_SESSION["id_admin"]));
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo 'username updated';
        } else {
            echo 'username not updated';
        }
    } elseif (isset($_POST["saveName"])) {
        echo 'asled for username update';
        // Handle username update
        $newName = $_POST["name"];
        $stmt = $connection->prepare("UPDATE administrateurs SET nom = ? WHERE id_admin = ?");
        $stmt->execute(array($newName, $_SESSION["id_admin"]));
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo 'name updated';
        } else {
            echo 'name not updated';
        }
    }

    elseif (isset($_POST["saveSurname"])) {
        echo 'asled for saveSurname update';
        // Handle username update
        $newSurname = $_POST["surname"];
        $stmt = $connection->prepare("UPDATE administrateurs SET prenom = ? WHERE id_admin = ?");
        $stmt->execute(array($newSurname, $_SESSION["id_admin"]));
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo 'surname updated';
        } else {
            echo 'surname not updated';
        }
    }
    elseif (isset($_POST["saveEmail"])) {
        echo 'asled for saveSurname update';
        // Handle username update
        $newEmail = $_POST["email"];
        $stmt = $connection->prepare("UPDATE administrateurs SET email = ? WHERE id_admin = ?");
        $stmt->execute(array($newEmail, $_SESSION["id_admin"]));
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo 'email updated';
        } else {
            echo 'email not updated';
        }
    }

    elseif (isset($_POST["savePassword"])) {
        echo 'asled for saveSurname update';
        // Handle username update
        $newPassword = sha1($_POST["password"]);
        $stmt = $connection->prepare("UPDATE administrateurs SET password = ? WHERE id_admin = ?");
        $stmt->execute(array($newPassword, $_SESSION["id_admin"]));
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo 'password updated';
        } else {
            echo 'password not updated';
        }
    }
}
?>
