<?php 
session_start();
require_once 'conexion.php';

if(isset($_POST['submit_login'])){
    $emailadmited = strtolower(trim($_POST['email']));
    $passadmited = $_POST['pass'];

    // Sentencia preparada para buscar el usuario por email
    $stmt = $link -> prepare ("SELECT document, pass FROM users WHERE email = ? LIMIT 1");

    if(!$stmt){
        $_SESSION['login_error'] = "Internal system error. Please try again later.";
        header("Location: ../login.php");
        // No se puede cerrar $link si $stmt falló en la preparación
        exit();
    }

    $stmt -> bind_param('s', $emailadmited);
    $stmt -> execute();
    
    $result = $stmt -> get_result();
    $user = $result -> fetch_assoc();

    $error = "Incorrect email address or password.";

    // Verificar si el usuario fue encontrado (falla por email)
    if(!$user){
        $_SESSION['login_error'] = $error;

        $stmt -> close();
        $link -> close();
        header("Location: ../login.php");
        exit();
    }
    
    // Verificar la contraseña
    if(password_verify($passadmited, $user['pass'])){
        // Login Exitoso
        $_SESSION['user_document'] = $user['document'];
        $_SESSION['user_email'] = $emailadmited;

        $stmt -> close();
        $link -> close();
        header("Location: ../index.php");
        exit();

    }else{
        // Contraseña incorrecta
        $_SESSION['login_error'] = $error;

        $stmt -> close();
        $link -> close();
        header("Location: ../login.php");
        exit();
    }
}

header("Location: ../login.php");
exit();
?>
