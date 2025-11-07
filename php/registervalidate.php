<?php 

    session_start();
    // Aseguramos la conexion a la base de datos.
    require_once 'conexion.php';

    if (isset($_POST['submit'])){

        // Estandarizacion de datos.
        $user = trim($_POST['user']);
        $document = trim($_POST['document']);
        $email = strtolower(trim($_POST['email']));
        $pass = $_POST['pass'];

        // Cifrado de la contrasena utilizando password_hash.
        //$pass_hash = password_hash($pass, PASSWORD_DEFAULT);   (No funciona por incompatibilidad con XAMPP.)
        $pass_hash = $pass;

        // Verificamos si hay un Email existente en la base de datos.
        $stmt_email = $link -> prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
        $stmt_email -> bind_param('s', $email);
        $stmt_email -> execute();
        $stmt_email -> store_result();

        if ($stmt_email -> num_rows > 0){
            $_SESSION['register_error'] = "The email " . htmlspecialchars($email) . " is already registered.";
            $stmt_email -> close();
            $link -> close();
            header("Location: ../register.php");
            exit(); 
        }
        $stmt_email -> close();

        // Verificamos si hay un Documento existente en la base de datos.
        $stmt_doc = $link -> prepare("SELECT document FROM users WHERE document = ? LIMIT 1");
        $stmt_doc -> bind_param('i', $document);
        $stmt_doc -> execute();
        $stmt_doc -> store_result();

        if ($stmt_doc -> num_rows > 0){
            $_SESSION['register_error'] = "The document " . htmlspecialchars($document) . " already exists.";
            $stmt_doc -> close();
            $link -> close();
            header("Location: ../register.php");
            exit();
        }
        $stmt_doc -> close ();

        // Realizamos la insercion a la base de datos con SQL.
        $sql = $link -> prepare("INSERT INTO users (user, document, email, pass) VALUES (?, ?, ?, ?)");
        $sql -> bind_param('siss', $user, $document, $email, $pass_hash);

        if ($sql -> execute()){
            // Nos redirecciona al login, luego de un registro exitoso.
            $sql -> close();
            $link -> close();
            header("Location: ../login.php");
            exit();

        } else {
            // Controla el error de la insercion redireccionandonos nuevamente al mismo archivo.
            $_SESSION['register_error'] = "Error registering user. Try again. (" . $sql -> error . ")";
            $sql -> close();
            $link -> close();
            header("Location: ../register.php");
            exit();
        }

    }

    // Nos redirecciona por acceso directo.
    header("Location: ../register.php");
    exit();

?>