<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Vinculamos todos los archivos necesarios. -->
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <?php
        // Verifica si existe un mensaje de error en la sesión.
        if (isset($_SESSION['registro_error'])):
    ?>

    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px auto; width: 80%; max-width: 400px; border-radius: 5px; text-align: center;">
        <p><?php echo $_SESSION['registro_error']; ?></p>
    </div>

    <?php
        // Una vez mostrado el error, lo borramos de la sesión para que no se muestre al recargar.
            unset($_SESSION['registro_error']);
        endif;
    ?>

    <!-- Titulo centrado que estara a la izquierda del registro. -->
    <h1 class="titlepage">FILL IN THE FIELDS TO REGISTER</h1>
    <!-- Formulario para realizar un registro de usuario a traves el metodo POST. -->
    <form action="php/registervalidate.php" class="register" method="post">
        <!-- Box principal, dividido por otros divs que contienen todos los titulos, inputs, imagenes y botones. -->
        <div class="boxregister"> 
            <h2 class="title">Register</h2>
            <div class="input-container">
                <img src="img/person-icon.png" alt="User-Icon">
                <input type="text" placeholder="User" name="user" id="user" required>
            </div>
            <div class="input-container">
                <img src="img/document-icon.png" alt="Document-Icon">
                <input type="number" placeholder="Document" name="document" id="document" required>
            </div>
            <div class="input-container">
                <img src="img/email-icon.png" alt="Gmail-Icon">
                <input type="email" placeholder="Gmail" name="email" id="email" required>
            </div>
            <div class="input-container">
                <img src="img/password-icon.png" alt="Password-Icon">
                <input type="password" placeholder="Password" name="pass" id="pass" required>
            </div>
            <div class="button-container">
                <button type="submit" class="buttonregister" name="submit">Register</button>
            </div>
            <!-- Hipervinculo hacia el archivo login.php, en el caso de ya tener una cuenta. -->
            <div class="login-container">
                <p>Already have an account? <a href="login.php">Return</a></p>
            </div>
        </div>
    </form>
    
</body>
</html>