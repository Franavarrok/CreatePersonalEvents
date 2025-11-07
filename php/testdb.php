<?php
// Incluye tu conexión. Esto probará si tu archivo conexion.php funciona.
require_once 'conexion.php'; 

$email_a_buscar = 'test@gmail.com'; // **<-- REEMPLAZA ESTO CON TU EMAIL DE PRUEBA**

// Sentencia SQL para buscar el usuario
$stmt = $link->prepare("SELECT document, pass FROM users WHERE email = ? LIMIT 1");

if ($stmt === false) {
    die("ERROR 1: Fallo en la preparación de la consulta SQL. Revisa el nombre de la tabla 'users' o las columnas 'document'/'pass'.");
}

$stmt->bind_param('s', $email_a_buscar);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    // Si ves este mensaje, significa que la consulta se ejecutó, pero el email NO fue encontrado.
    die("ERROR 2: La consulta no encontró el email '$email_a_buscar'."); 
}

// Si llegamos aquí, el usuario EXISTE.
echo "ÉXITO: Usuario encontrado. Documento: " . $user['document'] . "<br>";

// Contraseña que debes usar para entrar al sitio (la contraseña PLANA)
$pass_plana = '123456'; // **<-- REEMPLAZA ESTO CON TU CONTRASEÑA PLANA**
$hash_almacenado = $user['pass'];

if (password_verify($pass_plana, $hash_almacenado)) {
    // Si ves este mensaje, ¡el login debería funcionar!
    echo "ÉXITO: Contraseña verificada. El problema es la sesión o la redirección.";
} else {
    // Si ves este mensaje, la única falla es que la contraseña PLANA no coincide con el hash.
    echo "ERROR 3: Falló la verificación de contraseña. La contraseña que usaste NO coincide con el hash almacenado.";
}

$stmt->close();
$link->close();
?>