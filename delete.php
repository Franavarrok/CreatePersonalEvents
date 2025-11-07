<?php
require_once 'conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = $link->prepare("DELETE FROM events WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: ../event.php");
        exit();
    } else {
        echo "Error al eliminar el evento.";
        header("Location: ../event.php");
        exit();
    }

} 

?>
