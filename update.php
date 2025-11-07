<?php
require_once 'php/conexion.php';

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

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/update.css">
</head>
<body>

    <?php include 'php/navbar.php'; ?>

    <form action="php/updatevalidate.php" method="post">
        <div class="main-container">
            <h2 class="title">UPDATE INFORMATION</h2>
            <div class="input-container">
                <input type="hidden" name="id" value="<?= $event['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required><br>
                <input type="text" name="description" value="<?= htmlspecialchars($event['description']) ?>" required><br>
                <input type="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required><br>
                <button type="submit" name="submit" class="savebutton">SAVE</button>
            </div>
        </div>
    </form>

</body>
</html>
