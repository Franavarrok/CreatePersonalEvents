<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $link->prepare("SELECT * FROM events WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();
    $event = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Event</title>
</head>
<body>
    <h2>Update Event</h2>

    <form action="php/updatevalidate.php" method="post">
        <input type="hidden" name="id" value="<?= $event['id'] ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required><br>
        <input type="text" name="description" value="<?= htmlspecialchars($event['description']) ?>" required><br>
        <input type="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required><br>
        <button type="submit" name="submit">Save Changes</button>
    </form>
</body>
</html>
