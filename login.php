<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Vinculamos todos los archivos necesarios. -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <!-- Titulo centrado que estara a la izquierda del login. -->
    <h1 class="titlepage">PERSONAL EVENT CREATOR</h1>
    <!-- Formulario para realizar el logueo de un usuario a traves del metodo POST. -->
    <form action="php/loginvalidate.php" class="login" method="post">
        <!-- Box principal, dividido por otros divs que contienen todos los titulos, inputs, imagenes y botones. -->
        <div class="boxlogin">

            <h2 class="title">Sign In</h2>

            <div class="input-container">
                <img src="img/email-icon.png" alt="Gmail-Icon">
                <input type="email" placeholder="Gmail" name="email" id="email">
            </div>
            <div class="input-container">
                <img src="img/password-icon.png" alt="Password-Icon">
                <input type="password" placeholder="Password" name="pass" id="pass">
            </div>
            <div class="button-container">
                <button type="submit" class="buttonlogin">Login</button>
            </div>
            <!-- Hipervinculo hacia el archivo register.php, en el caso de no tener cuenta. -->
            <div class="register-container">
                <p>Don't have an account?  <a href="register.php">Register</a></p>
            </div>
        </div>
    </form>
    
</body>
</html>