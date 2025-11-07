<?php 

    session_start();
    require_once 'conexion.php';

    if (isset($_POST['submit_login'])){

        // Estandarizacion del email.
        $email = strtolower(trim($_POST['email']));
        $pass = $_POST['pass'];

        // Sentencia SQL para buscar el usuario por email y obtener el hash.
        $sql = $link -> prepare("SELECT document, pass FROM users WHERE email = ? LIMIT 1");

        if (!$sql){
            $_SESSION['login_error'] = "Internal system error. Failed to prepare query.";
            header("Location: ../login.php");
            exit();
        }

        $sql -> bind_param('s', $email);
        $sql = execute();

        $error = "Incorrect email address or password.";

        // Verificamos si el usuario fue encontrado.
        if (!$user){
            $_SESSION['login_error'] = $error;
            $sql -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();
        }

        // Verificamos la contrasena utilizando password_verify.
        if (password_verify($pass, $user['pass'])){
            $_SESSION['user_document'] = $user['document'];

            // Utilizamos $email para la sesion.
            $_SESSION['user_email'] = $email;

            $sql -> close();
            $link -> close();
            header("Location: ../index.php");
            exit();

        } else {
            // Si la contrasena es incorrecta.
            $_SESSION['login_error'] = $error;
            $sql -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();
        }

    }

    // Nos redirecciona por acceso directo.
    header("Location: ../login.php");
    exit();

?>