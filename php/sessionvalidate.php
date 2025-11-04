<?php 
    //Comienzo de sesion.
    session_start();

    //Si la sesion del usuario es diferente, nos redirecciona al archivo 'login.php'.
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
?>