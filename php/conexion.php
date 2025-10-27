<?php

    $dbserver = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "createpersonalevent";

    $link = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if(!$link){
        die ("Error connecting to database" . $link -> connect_error);
    }
    
?>



