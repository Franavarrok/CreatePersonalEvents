<?php

    //require_once asegura que el archivo se cargue solo una vez.
    //Incluye el archivo de conexion a la base de datos.
    require_once 'conexion.php';

    //Verifica si el formulario fue enviado.
    if(isset($_POST['submit'])){

        //Cada campo del formulario (title, description, date) se guarda en una variable.
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        $sql = $link->prepare("INSERT INTO events (title, description, date) VALUES (?, ?, ?)");
        $sql -> bind_param('sss', $title, $description, $date);

        if($sql->execute()){
            header("Location: ../event.php");
            exit();

        } else {
            echo "Error: " . $sql->error;
            header("Location: ../create.php");
            exit();
        }

        $sql->close();
        $link->close();
    } 

?>