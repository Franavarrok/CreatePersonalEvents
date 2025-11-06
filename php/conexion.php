<?php

    //Variables para vincular la base de datos.
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "createpersonalevent";
    
    //Se crea una variable para asignarle la conexion a la base de datos.
    $link = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    //Condicion simple que indica que si la conexion es diferente tira un mensaje de error.
    if($link-> connect_error) {
        die ("Error connecting to database" . $link -> connect_error);
    }
    
?>



