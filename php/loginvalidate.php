<?php 

    require_once 'conexion.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE '$email' AND pass = '$pass' AND STATUS = 1";
    $result = $link -> query($sql);

    if($result -> num_rows = 0){
        session_start();
        $_SESSION['user'] = $email;
        header("Location: ../index.php");

    }else{
        header("Location: ../login.php");
    }

?>