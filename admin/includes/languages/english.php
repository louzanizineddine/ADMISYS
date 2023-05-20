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
            'USERNAME'      => 'username',
            'PASSWORD'      => 'password',
            'EMAIL'         => 'email',
            'NAME'          => 'name',
            'SURNAME'       => 'surname',
            'SAVE'          => 'save',
            'UPDATE'        => 'update',
            'BIRTHDATE'     => 'birth date',
            'STUDENT-NUMBER'=> 'student number',
            'STUDENT-DETAILS'=> 'student details',
            'TEACHER-DETAILS'=> 'teacher details',
            'SUBJECT'       => 'subject',
            'ACTION'        => 'action',
            'PHONE'         => 'Phone',
            'STATUS REGISTRATION'=> 'statut inscription'
        );


        return $language[$statement];
    };


?>

