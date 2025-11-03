<?php

    require_once 'conexion.php';

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        $sql = $link->prepare("INSERT INTO events (title, description, date) VALUES (?, ?, ?)");
        $sql -> bind_param('sss', $title, $description, $date);

        if($sql->execute()){
            echo "You registered successfully";
        } else{
            echo "Error: " . $sql->error;
        }

        $sql->close();
        $link->close();
    } 

?>