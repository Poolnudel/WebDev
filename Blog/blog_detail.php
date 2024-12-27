<?php
    session_start();
    // Prüfen, ob der Benutzer eingeloggt ist
    if (!isset($_SESSION['user_id'])) {
        // Benutzer ist nicht eingeloggt, Weiterleitung zur Login-Seite
        header("Location: logInReg.php");
        exit;
    }

    // Verbindung zur Datenbank herstellen
    include 'components/db.php';

    // Prüfen, ob kursId in der URL übergeben wurde
    if (isset($_GET['kursId']) && is_numeric($_GET['kursId'])) {
        $kursId = (int) $_GET['kursId']; // kursId aus der URL holen und sicherstellen, dass es eine Zahl ist

        // Beitrag aus der Datenbank abrufen
        $beitragSql = "SELECT kursTitel, kursText, kursBild FROM beitrag WHERE kursId = $kursId";
        $beitragResult = mysqli_query($conn, $beitragSql);

        if ($beitragResult && mysqli_num_rows($beitragResult) > 0) {
            $beitrag = mysqli_fetch_assoc($beitragResult);
        } else {
            die("Beitrag nicht gefunden.");
        }

        // Kommentare zu diesem Beitrag abrufen
        $kommentareSql = "SELECT nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText, kommentare.kommentarBild 
                        FROM kommentare
                        JOIN nutzer ON kommentare.userId = nutzer.userId
                        WHERE kommentare.kursId = $kursId";
        $kommentareResult = mysqli_query($conn, $kommentareSql);
    } else {
        die("Ungültige Kurs-ID.");
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detailseite</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/png" href="images/winf-logo.png">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <?php include 'components/navbar.php'; // Navbar einbinden ?>

    <!-- Detailansicht -->
    <div class="detail-container">
        <div class="detail-header">
            <h1 class="detail-title"><?= htmlspecialchars($beitrag['kursTitel']); ?></h1>
            <p class="detail-meta">Beitrag ID: <?= htmlspecialchars($kursId); ?></p>
        </div>

        <div class="detail-content">
            <img src="images/<?= htmlspecialchars($beitrag['kursBild']); ?>" alt="Beitragsbild" style="max-width: 100%; margin-bottom: 1rem;">
            <?= nl2br($beitrag['kursText']); ?>
        </div>

        <?php
            include 'components/commentSection.php';
        ?>

    </div>

    
</body>

<?php include 'components/footer.php'; 
// Datenbankverbindung wird am Ende geschlossen
mysqli_close($conn);
?>

</html>
