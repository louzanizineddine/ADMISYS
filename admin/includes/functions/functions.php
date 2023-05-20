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

function insertNewline($string) {
    $words = explode(' ', $string); // Split the string into an array of words
    $count = count($words);
    $newString = '';

    for ($i = 0; $i < $count; $i++) {
        $newString .= $words[$i] . ' '; // Add the current word to the new string

        // Check if the current word index is a multiple of 10 or 15
        if (($i) % 20 === 0) {
            $newString .= "<br>"; // Insert a line break using <br>
        }
    }

    return trim($newString); // Remove any extra spaces at the end and return the modified string
}