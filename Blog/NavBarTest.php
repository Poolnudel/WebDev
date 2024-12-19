<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
    </style>
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="images/winf-logo.png" alt="WInf Logo">
        </div>
        <?php

session_start();
require_once 'db_connection.php';

// Funktion, um die Kurse aus der Datenbank zu laden
function getCourses($conn) {
    $sql = "SELECT kurs_kurz_name FROM kurse";
    $result = $conn->query($sql);
    $courses = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row['kurs_kurz_name'];
        }
    }
    return $courses;
}

$courses = getCourses($conn);
?>

<section class="hero">
<h1>Vorlesungsveranstaltungen der Wirtschaftsinformatik</h1>
<nav>
    <ul>
        <!-- Link zur Homepage -->
        <li><a href="index.php">Home</a></li>

        <!-- Login/Logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>

        <!-- Dynamische Liste der Kurse -->
        <li class="dropdown">
            <a href="#">Kurse</a>
            <ul class="dropdown-menu">
                <?php foreach ($courses as $course): ?>
                    <li><a href="course.php?name=<?= urlencode($course) ?>"><?= htmlspecialchars($course) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
    </ul>
</nav>
</section>

<style>
    /* temporäres CSS */
    nav ul {
        list-style: none;
        display: flex;
        padding: 0;
        margin: 0;
    }
    nav ul li {
        margin: 0 10px;
        position: relative;
    }
    nav ul li a {
        text-decoration: none;
        color: white;
        padding: 10px 15px;
        display: block;
    }
    nav ul li:hover .dropdown-menu {
        width: 6rem;
        display: block;
        background: linear-gradient(to right, #294936, #3E6259);
    }
    .dropdown-menu {
        display: none;
        position: absolute;
        background: #444;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .dropdown-menu li {
        margin: 0;
    }
    .dropdown-menu li a {
        padding: 10px 15px;
    }
</style>

    </header>
    <main>
        <h1>Home</h1>
        <p>mooin</p>
    </main>

    <!-- Fußzeile -->
    <footer>
        <div class="footer-content">
            <a href="impressum.html">Impressum</a> | <a href="kontakt.html">Kontakt</a>
        </div>
    </footer>
</body>
</html>