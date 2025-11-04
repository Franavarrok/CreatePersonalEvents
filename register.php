<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <h1 class="titlepage">FILL IN THE FIELDS TO REGISTER</h1>

    <form action="php/registervalidate.php" class="register" method="post">
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
            <div class="login-container">
                <p>Already have an account? <a href="login.php">Return</a></p>
            </div>
        </div>
    </form>
    
</body>
</html>