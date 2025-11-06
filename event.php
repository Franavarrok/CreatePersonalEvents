<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <!-- Vinculamos todos los archivos necesarios. -->
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/event.css">
</head>
<body>

    <!-- Incluimos nuestro archivo navbar.php, que contiene toda la estructura del nav en HTML. -->
    <?php include 'php/navbar.php'; ?>

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
                

</body>
</html>