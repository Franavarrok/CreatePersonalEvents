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

    if(!$user){
    // ... (El bloque de error de email que ya tienes)
    }

    // 🛑 INICIO DE CÓDIGO DE DEPURACIÓN EXTREMA 🛑
    echo "<h1>DEBUG EXTREMO - ELIMINAR DESPUÉS DE LA PRUEBA</h1>";
    echo "<h2>1. Email BUSCADO (PHP):</h2> " . $emailadmited . "<br>";
    echo "<h2>2. Contraseña PLANA INGRESADA:</h2> " . htmlspecialchars($passadmited) . "<br>";
    echo "<h2>3. Hash RECUPERADO DE LA BD:</h2> " . $user['pass'] . "<br>";
    if (password_verify($passadmited, $user['pass'])) {
        echo "<h1 style='color:green;'>4. RESULTADO DE VERIFY: ¡EXITOSO! (El login debería funcionar)</h1>";
    } else {
        echo "<h1 style='color:red;'>4. RESULTADO DE VERIFY: ¡FALLIDO! (Aquí se rompe)</h1>";
    }
    exit();

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
