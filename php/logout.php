<?php
session_start();       // Inicia la sesión actual
session_unset();       // Elimina todas las variables de sesión
session_destroy();     // Destruye la sesión por completo

// Redirige al login (que está fuera de la carpeta php)
header("Location: ../login.php");
exit();
?>
