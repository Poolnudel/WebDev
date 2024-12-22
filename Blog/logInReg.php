<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registrierung</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

    <?php
    include 'components/header.php'; 
    include 'components/db.php'; // Datenbankverbindung einbinden
    session_start(); // Session starten, um Benutzerdaten zu speichern
    $popUpMessage = ""; // Nachrichten-Variable initialisieren

    // Registrierung
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Passwörter überprüfen
        if ($password !== $confirmPassword) {
            $popupMessage = "Passwörter stimmen nicht überein!";
        } else {
            // Nutzer in die Datenbank einfügen
            $sql = "INSERT INTO Nutzer (userEmail, userPasswort) VALUES ('$email', '$password')";
            if (mysqli_query($conn, $sql)) {
                $popupMessage = "Registrierung erfolgreich! Sie können sich jetzt einloggen.";
            } else {
                $popupMessage = "Fehler: " . mysqli_error($conn);
            }
        }
    }

    // Login
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Benutzer aus der Datenbank abrufen
        $sql = "SELECT * FROM Nutzer WHERE userEmail = '$email' AND userPasswort = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Benutzer in die Session speichern
            $_SESSION['user_id'] = $user['userId'];
            $_SESSION['user_email'] = $user['userEmail'];

            header("Location: index.php"); // Weiterleitung zur Startseite
            exit;
        } else {
            $popupMessage = "Falsche E-Mail oder falsches Passwort.";
        }
    }
    ?>

    <!-- Pop-up Meldung -->
    <?php if (!empty($popupMessage)): ?>
        <script>
            alert("<?= $popupMessage; ?>");
        </script>
    <?php endif; ?>

    <!-- Login / Registrierung -->
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
        </div>

        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Einloggen</button>
            </div>
        </form>

        <div class="toggle-link" onclick="toggleForm()" style="margin-bottom: 16px;">Noch kein Konto? Jetzt registrieren</div>

        <form id="register-form" method="POST" style="display: none;">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Passwort bestätigen</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="register">Registrieren</button>
            </div>
        </form>
    </div>

    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const toggleLink = document.querySelector('.toggle-link');

            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                toggleLink.textContent = 'Noch kein Konto? Jetzt registrieren';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                toggleLink.textContent = 'Bereits ein Konto? Jetzt einloggen';
            }
        }
    </script>

    <?php include 'components/footer.php'; ?>
</body>
</html>
