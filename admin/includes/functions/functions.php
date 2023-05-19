<?php
    /* function to get the tile of the page
        if the page has the variable $pageTitle
        echo the variable $pageTitle
        else echo the default title
    */

    function bringTitle() {
        global $pageTitle;
        if (isset($pageTitle)) {
            echo $pageTitle;
        }else {
            echo 'Default';
        }
    }