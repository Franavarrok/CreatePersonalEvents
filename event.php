<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/event.css">
</head>
<body>

    <?php include 'php/navbar.php'; ?>

    <?php if (isset($_GET['deleted'])): ?>
    <p style="color: lime; text-align: center;"> Evento eliminado correctamente</p>
    <?php endif; ?>


    <?php
    require_once 'php/conexion.php';

    // Consulta para traer los eventos
    $sql = "SELECT * FROM events ORDER BY date DESC";
    $result = $link->query($sql);
    ?>

    <div class="first-container">
        <h2 class="title-event">My Events</h2>
    </div>

    <div class="main-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                
                <div class="event-card"> 

                    <div class="events">
                        <div class="title">
                            <strong>Title:</strong> <?= htmlspecialchars($row['title']) ?>
                        </div>
                        <div class="description">
                            <strong>Description:</strong> <?= htmlspecialchars($row['description']) ?>
                        </div>
                        <div class="date">
                            <strong>Date:</strong> <?= htmlspecialchars($row['date']) ?>
                        </div>
                    </div>

                    <div class="button-type">
                        <form action="update.php" method="get">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="button-update">UPDATE</button>
                        </form>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="button-delete">DELETE</button>
                        </form>
                    </div>

                </div> 
                <?php endwhile; ?>
        <?php else: ?>
            <p style="color:white; text-align:center;">No hay eventos guardados aún.</p>
        <?php endif; ?>
    </div>

</body>
</html>
