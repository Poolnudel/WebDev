<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wirtschaftsinformatik</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/png" href="images/winf-logo.png">
</head>
<body>

    <?php
    session_start();
    // Prüfen, ob der Benutzer eingeloggt ist
    if (!isset($_SESSION['user_id'])) {
        // Benutzer ist nicht eingeloggt, Weiterleitung zur Login-Seite
        header("Location: logInReg.php");
        exit;
    }

    include 'components/header.php'; // Header einbinden
    ?>

    <?php include 'components/navbar.php'; ?>

    <!-- Hero-Bereich mit Grafik und Titel -->
    <!--     
    <section class="hero">
        <h1>Vorlesungsveranstaltungen der Wirtschaftsinformatik</h1>
    </section> 
    -->

    <!-- Galerie für Veranstaltungen -->
    <section class="veranstaltungen">
        <a href="blog_detail.php?kursId=1" class="veranstaltung">
            <div class="text">
                Application Development
            </div>
            <div class="image" style="background-image: url('images/kachel_appDev.webp');">
            </div>
        </a>
        <a href="blog_detail.php?kursId=2" class="veranstaltung">
            <div class="text">
                Web Development
            </div>
            <div class="image" style="background-image: url('images/kachel_webDev.png');">
            </div>
        </a>
        <a href="blog_detail.php?kursId=3" class="veranstaltung">
            <div class="text">
                IT Infrastrukturen
            </div>
            <div class="image" style="background-image: url('images/kachel_itInfrastructure.webp');">
            </div>
        </a>
        <a href="blog_detail.php?kursId=4" class="veranstaltung">
            <div class="text">
                IT Architekturen
            </div>
            <div class="image" style="background-image: url('images/kachel_itArchitecture.jpg');">
            </div>
        </a>
    </section>

    <?php include 'components/footer.php'; // Footer einbinden ?>
</body>
</html>
