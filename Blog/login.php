<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="images/winf-logo.png" alt="Logo">
        </div>
    </header>
    <div class="login">
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <p>Noch keinen Account? <a href="register.php">Registrieren</a></p>
        </div>
    </div>

    <!-- Fußzeile -->
    <footer>
        <div class="footer-content">
            <a href="impressum.html">Impressum</a> | <a href="kontakt.html">Kontakt</a>
        </div>
    </footer>
</body>
</html>