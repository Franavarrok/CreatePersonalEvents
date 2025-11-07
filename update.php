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

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/update.css">
</head>
<body>

    <form action="php/updatevalidate.php" method="post">
        <div class="main-container">
            <?php if ($result && $result->num_rows > 0): ?>
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td class="action-buttons">
                                <form action="php/update.php" method="get" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="button-update">UPDATE</button>
                                </form>
                                <form action="php/delete.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="button-delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p style="color:white; text-align:center;">No hay eventos guardados aún.</p>
            <?php endif; ?>
        </div>
    </form>

</body>
</html>
