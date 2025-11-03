<?php

    require_once 'conexion.php';

    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $document = $_POST['document'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql = $link->prepare("INSERT INTO users (user, document, email, pass) VALUES (?, ?, ?, ?)");
        $sql -> bind_param('siss', $user, $document, $email, $pass);

        if($sql->execute()){
           header(Location: '../login.html');
        } else{
            echo "Error: " . $sql->error;
        }

        $sql->close();
        $link->close();
    } 

?>