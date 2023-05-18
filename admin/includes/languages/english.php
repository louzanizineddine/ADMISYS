<?php

    function lang($statement) {
        static $language = Array(
            // admin page
            'HOME'          => 'home',
            'STUDENTS'      => 'students',
            'TEACHERS'      => 'teachers',
            'INSCRIPTIONS'  => 'inscriptions',
            'NEWS'          => 'news',
            'LOGOUT'        => 'logout',
            'SETTINGS'      => 'settings',
            'EDIT-PROFILE'  => 'edit profile',
        );


        return $language[$statement];
    };


?>

