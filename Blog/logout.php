<?php
// Alle Session-Variablen löschen
$_SESSION = array();

// Session-Cookie löschen
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Session beenden
//session_destroy();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/png" href="images/winf-logo.png">
</head>
<body>

    <?php include 'components/header.php'; ?>

    <!-- Logout-Bestätigung -->
    <div class="login-container">
        <h1>Logout erfolgreich</h1>
        <p>Sie wurden erfolgreich ausgeloggt.</p>
        <a href="index.php" class="toggle-link">Zurück zur Startseite</a>
    </div>

    <?php include 'components/footer.php'; ?>
</body>