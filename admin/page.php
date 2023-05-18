<?php

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if($action == 'Manage') {
        echo 'welcome to manage page';
    }
    elseif ($action == 'Add') {
        echo 'welcome to add page';
    }
    elseif ($action == 'Insert') {
        echo 'welcome to insert page';
    }
    elseif ($action == 'Edit') {
        echo 'welcome to edit page';
    }
    elseif ($action == 'Delete') {
        echo 'welcome to delete page';
    }
    else {
        echo 'error';
    }