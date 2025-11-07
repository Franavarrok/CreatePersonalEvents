<?php 
    session_start();
    require_once 'conexion.php';

    if (isset($_POST['submit_login'])){
        
        // Estandarización del email.
        $email = strtolower(trim($_POST['email']));
        $pass = $_POST['pass']; // Contraseña plana ingresada

        // Sentencia SQL que verifica email Y contraseña.
        $sql = $link -> prepare ("SELECT document, pass FROM users WHERE email = ? AND pass = ? LIMIT 1");

        if(!$sql){
            $_SESSION['login_error'] = "Internal system error. Failed to prepare query.";
            header("Location: ../login.php");
            exit();
        }

        // Vinculamos los dos parámetros (email Y contraseña).
        $sql -> bind_param('ss', $email, $pass); 
        $sql -> execute();
        
        $result = $sql -> get_result();
        $user = $result -> fetch_assoc();

        $error = "Incorrect email address or password.";

        // Verificamos el resultado: Si $user existe, el login es exitoso.
        if($user){ 
            // Login Exitoso
            $_SESSION['user_document'] = $user['document'];
            $_SESSION['user_email'] = $email;

            $sql -> close();
            $link -> close();
            header("Location: ../index.php");
            exit();

        }else{
            // Email O Contraseña incorrectos
            $_SESSION['login_error'] = $error;

            $sql -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();
        }
    }

    // Redirección por acceso directo
    header("Location: ../login.php");
    exit();
    
?>