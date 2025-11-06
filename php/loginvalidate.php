<?php 

    session_start();
    require_once 'conexion.php';

    if(isset($_POST['submit_login'])){
        $emailadmited = $_POST['email'];
        $passadmited = $_POST['pass'];

        $stmt = $link -> prepare ("SELECT document, pass FROM users WHERE email = ? LIMIT 1");

        if(!$stmt){
            $_SESSION['login_error'] = "Internal system error. Please try again later.";
            header("Location: ../login.php");
            exit();
        }

        $stmt -> bind_param('s', $emailadmited);
        $stmt -> execute();
        
        $result = $stmt -> get_result();
        $user = $result -> fetch_assoc();

        $error = "Incorrect email address or password.";

        if(!$user){
            $_SESSION['login_error'] = $error;

            $stmt -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();
        }

        if(password_verify($passadmited, $user['pass'])){
            $_SESSION['user_document'] = $user['document'];
            $_SESSION['user_email'] = $emailadmited;

            $stmt -> close();
            $link -> close();
            header("Location: ../index.php");
            exit();

        }else{
            $_SESSION['login_error'] = $error;

            $stmt -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();
        }

        $stmt -> close();
        $link -> close();

    }

    header("Location: ../login.php");
    exit();

?>
