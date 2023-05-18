<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['username'])) {
        $pageTitle = 'Edit Profile';
        include 'init.php';

        $action = isset($_GET['action']) ? $_GET['action'] : 'manage';

        if ($action == 'manage') {
            echo 'welcome to manage page';
        }
        // edit admin profile information
        elseif ($action == 'edit') { ?>

            <div class="container">
                <form class="edit-profile-admin mt-4" action="" method="post">
                <h2 class="mt-5"><?php echo lang("EDIT-PROFILE") ?></h2>
                    <div class="col-md-8 form-group mb-3">
                        <label for="username" class="form-label"><?php echo lang("USERNAME") ?></label>
                        <input class="form-control form-control-lg" type="text" id="username" placeholder="<?php echo lang("USERNAME") ?>" name="username" autocomplete="off" />
                    </div>
                    <div class="col-md-8 form-group mb-3">
                        <label for="name" class="form-label"><?php echo lang("NAME") ?></label>
                        <input class="form-control form-control-lg" type="text" id="name" placeholder="<?php echo lang("NAME") ?>" name="name" autocomplete="off" />
                    </div>
                    <div class="col-md-8 form-group mb-3">
                        <label for="surname" class="form-label"><?php echo lang("SURNAME") ?></label>
                        <input class="form-control form-control-lg" type="text" id="surname" placeholder="<?php echo lang("SURNAME") ?>" name="surname" autocomplete="off" />
                    </div>
                    <div class="col-md-8 form-group mb-3">
                        <label for="email" class="form-label"><?php echo lang("EMAIL") ?></label>
                        <input class="form-control form-control-lg" type="email" id="email" placeholder="<?php echo lang("EMAIL") ?>" name="email" autocomplete="off" />
                    </div>
                    <div class="col-md-8 form-group mb-3">
                        <label for="password" class="form-label"><?php echo lang("PASSWORD") ?></label>
                        <input class="form-control form-control-lg" type="password" id="password" placeholder="<?php echo lang("PASSWORD") ?>" name="password" autocomplete="new-password" />
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block btn-lg" type="submit"><?php echo lang("SAVE") ?></button>
                    </div>
                </form>
            </div>



            <?php ;}

        // include the footer
        include $tpl . 'footer.php';
    } else {
    //    echo 'you are not authorized to view this page';
        header('Location: index.php');
        exit();
}