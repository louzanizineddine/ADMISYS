<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php echo lang("HOME")?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="students.php"><?php echo  lang("STUDENTS")?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teachers.php"><?php echo  lang("TEACHERS")?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo  lang("INSCRIPTIONS")?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php"><?php echo  lang("NEWS")?></a>
                </li>
            </ul>
            <form class="d-flex justify-content-center">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username']?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <a class="nav-link" href="admin-edit-profile.php">
                                <?php echo lang("EDIT-PROFILE")?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> <?php echo lang("SETTINGS")?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"> <?php echo lang("LOGOUT")?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
