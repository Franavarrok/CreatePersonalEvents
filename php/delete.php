<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepara y ejecuta la eliminación
    $sql = $link->prepare("DELETE FROM events WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        // Redirige si se elimina correctamente
        header("Location: ../event.php");
        exit();
    } else {
        // Redirige si falla
        header("Location: ../event.php?error=delete_failed");
        exit();
    }

    $sql->close();
    $link->close();
} else {
    // Si acceden sin POST, redirige igual
    header("Location: ../event.php");
    exit();
}
?>
