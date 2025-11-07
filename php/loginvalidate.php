<?php 
session_start();
require_once 'conexion.php';

if(isset($_POST['submit_login'])){
    $emailadmited = strtolower(trim($_POST['email']));
    $passadmited = $_POST['pass'];

    // Consulta SQL que verifica email y contraseña.
    $stmt = $link -> prepare ("SELECT document, pass FROM users WHERE email = ? AND pass = ? LIMIT 1");

    if(!$stmt){
        $_SESSION['login_error'] = "Internal system error. Please try again later.";
        header("Location: ../login.php");
        exit();
    }

    // Vinculamos dos parámetros (email Y contraseña).
    $stmt -> bind_param('ss', $emailadmited, $passadmited); 
    $stmt -> execute();
    
    $result = $stmt -> get_result();
    $user = $result -> fetch_assoc();

    $error = "Incorrect email address or password.";

    // Si $user existe, es porque el email y la contraseña coinciden en la BD.
    if($user){ 
        // Login exitoso.
        $_SESSION['user_document'] = $user['document'];
        $_SESSION['user_email'] = $emailadmited;

        $stmt -> close();
        $link -> close();
        header("Location: ../index.php");
        exit();

    }else{
        // Email o contraseña incorrectos.
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