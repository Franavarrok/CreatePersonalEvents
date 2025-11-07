<?php

    session_start();

    require_once 'conexion.php';

    if(isset($_POST['submit'])){
        $user = trim($_POST['user']);
        $document = trim($_POST['document']);
        $email = trim($_POST['email']);
        $pass = $_POST['pass'];

        //Proceso que nos ayuda a cifrar la contrasena.
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        //Verificar si el Email ya existe en la base de datos.
        $stmt_email = $link -> prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
        $stmt_email -> bind_param('s', $email);
        $stmt_email -> execute();
        $stmt_email -> store_result();

        //Condicion que nos redigira a nuestro archivo registro.php si colocan un correo existente.
        if($stmt_email -> num_rows > 0){
            $_SESSION['registro_error'] = "The email " . htmlspecialchars($email) . " it is already registered.";
            header("Location: ../register.php");
            $stmt_email -> close();
            $link -> close(); 
            exit();
        }
        $stmt_email->close();

        //Verificar si el Documento ya existe en la base de datos.
        $stmt_doc = $link -> prepare("SELECT document FROM users WHERE document = ? LIMIT 1");
        $stmt_doc -> bind_param('i', $document);
        $stmt_doc -> execute();
        $stmt_doc -> store_result();

        if($stmt_doc -> num_rows > 0){
            $_SESSION['registro_error'] = "The document " . htmlspecialchars($document) . " it is already exists.";
            header("Location: ../register.php");
            $stmt_doc -> close(); 
            $link -> close();
            exit();
        }
        $stmt_doc -> close();

        $sql = $link -> prepare("INSERT INTO users (user, document, email, pass) VALUES (?, ?, ?, ?)");
        $sql -> bind_param('siss', $user, $document, $email, $pass_hash);

        if($sql->execute()){
            header("Location: ../login.php");
            $sql -> close();
            $link -> close(); 
            exit();
        }else{
            $_SESSION['registro_error'] = "Error registering user. Please try again. (" . $sql->error . ")";
            header("Location: ../register.php");
            $sql -> close();
            $link -> close(); 
            exit();
        }
    } 

?>