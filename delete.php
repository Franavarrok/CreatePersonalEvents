<?php
// Conectamos con la base de datos
require_once 'php/conexion.php';

// Si se recibió el formulario con el id del evento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    // Guardamos el id del evento a borrar
    $id = $_POST['id'];

    // Preparamos la consulta para borrar el evento
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id);

    // Ejecutamos
    if ($stmt->execute()) {
        // Si se borra bien, volver a la página de eventos
        header("Location: event.php?deleted=1");
        exit();
    } else {
        echo "❌ Error al eliminar el evento.";
    }

    // Cerramos la consulta
    $stmt->close();

} else {
    echo "❌ No se recibió ningún evento para borrar.";
}

// Cerramos la conexión
$link->close();
?>
