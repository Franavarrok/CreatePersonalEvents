<?php
require_once 'conexion.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = $link->prepare("UPDATE events SET title=?, description=?, date=? WHERE id=?");
    $sql->bind_param("sssi", $title, $description, $date, $id);

    if ($sql->execute()) {
        header("Location: ../event.php");
        exit();
    } else {
        echo "Error al actualizar el evento.";
    }
}
?>
