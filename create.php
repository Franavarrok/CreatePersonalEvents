<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>

    <!-- Vinculamos todos los archivos necesarios. -->
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/create.css">
</head>
<body>

    <!-- Incluimos nuestro archivo navbar.php, que contiene toda la estructura del nav en HTML. -->
    <?php include 'php/navbar.php'; ?>

    <div class="first-box">
        <div class="text-container">
            <h2 class="first">
                Do you need to create an event?
            </h2>
            <h3 class="second">
                Fill in all fields to save the data.
            </h3>
        </div>
    </div>

    <form action="php/createvalidate.php" method="post">
        <div class="event-box">
            <input type="text" placeholder="Title" name="title" id="title" required>
            <input type="varchar" placeholder="Description" class="description" name="description" id="description" required>
            <input type="date" placeholder="Date" name="date" id="date" required>
            <button type="submit" name="submit" class="buttonsave">SAVE</button>
        </div>
    </form>
    
</body>
</html>