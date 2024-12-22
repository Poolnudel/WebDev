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
    $beitragSql = "SELECT kursTitel, kursText, kursBild FROM Beitrag WHERE kursId = $kursId";
    $beitragResult = mysqli_query($conn, $beitragSql);

    if ($beitragResult && mysqli_num_rows($beitragResult) > 0) {
        $beitrag = mysqli_fetch_assoc($beitragResult);
    } else {
        die("Beitrag nicht gefunden.");
    }

    // Kommentare zu diesem Beitrag abrufen
    $kommentareSql = "SELECT Nutzer.userEmail, Kommentare.kommentarTitel, Kommentare.kommentarText, Kommentare.kommentarBild 
                      FROM Kommentare
                      JOIN Nutzer ON Kommentare.userId = Nutzer.userId
                      WHERE Kommentare.kursId = $kursId";
    $kommentareResult = mysqli_query($conn, $kommentareSql);
} else {
    die("Ungültige Kurs-ID.");
}

// Datenbankverbindung wird am Ende geschlossen
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detailseite</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <!-- Detailansicht -->
    <div class="detail-container">
        <div class="detail-header">
            <h1 class="detail-title"><?= htmlspecialchars($beitrag['kursTitel']); ?></h1>
            <p class="detail-meta">Beitrag ID: <?= htmlspecialchars($kursId); ?></p>
        </div>

        <div class="detail-content">
            <img src="images/<?= htmlspecialchars($beitrag['kursBild']); ?>" alt="Beitragsbild" style="max-width: 100%; margin-bottom: 1rem;">
            <p><?= nl2br(htmlspecialchars($beitrag['kursText'])); ?></p>
        </div>

        <div class="comments-section">
            <h2>Kommentare</h2>
            
            <?php if ($kommentareResult && mysqli_num_rows($kommentareResult) > 0): ?>
                <?php while ($kommentar = mysqli_fetch_assoc($kommentareResult)): ?>
                    <div class="comment">
                        <p class="comment-author"><?= htmlspecialchars($kommentar['userEmail']); ?></p>
                        <p class="comment-title"><?= htmlspecialchars($kommentar['kommentarTitel']); ?></p>
                        <p class="comment-text"><?= nl2br(htmlspecialchars($kommentar['kommentarText'])); ?></p>
                        <?php if ($kommentar['kommentarBild']): ?>
                            <img src="images/<?= htmlspecialchars($kommentar['kommentarBild']); ?>" alt="Kommentarbild" style="max-width: 100%;">
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Keine Kommentare vorhanden.</p>
            <?php endif; ?>

            <!-- Kommentarformular -->
            <div class="comment-form">
                <form method="POST" action="add_comment.php">
                    <textarea name="comment" rows="4" placeholder="Hinterlassen Sie einen Kommentar..."></textarea>
                    <button type="submit">Kommentar absenden</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>
</html>
