<?php

    function lang($statement) {
        static $language = Array(
            
            'GREETING' => 'Welcome',
        );


        return $language[$statement];
    };


?>

