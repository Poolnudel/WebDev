<?php
// Sicherstellen, dass kursId aus dem GET-Array verfügbar ist
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    echo "<p>Fehler: Ungültige oder fehlende Kurs-ID.</p>";
    return;
}

$kursId = (int)$_GET['kursId']; // Kurs-ID aus der URL

// SQL-Abfrage, um Kommentare und die Nutzer-E-Mail zu laden
$sql = "SELECT nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText 
        FROM kommentare
        JOIN nutzer ON kommentare.userId = nutzer.userId
        WHERE kommentare.kursId = $kursId";

include 'db.php';

$comments = mysqli_query($conn, $sql);

// Prüfen, ob die Abfrage erfolgreich war
if (!$comments) {
    echo "<p>Fehler beim Abrufen der Kommentare: " . mysqli_error($conn) . "</p>";
    return;
}
?>

<div class="comments-section">
    <h2>Kommentare</h2>

    <!-- Kommentare anzeigen -->
    <?php if (mysqli_num_rows($comments) > 0): ?>
        <?php while ($comment = mysqli_fetch_assoc($comments)): ?>
            <div class="comment">
                <p class="comment-author"><?= htmlspecialchars($comment['userEmail']); ?></p>
                <p class="comment-title"><?= htmlspecialchars($comment['kommentarTitel']); ?></p>
                <p class="comment-text"><?= nl2br(htmlspecialchars($comment['kommentarText'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Keine Kommentare vorhanden.</p>
    <?php endif; ?>

    <!-- Kommentarformular -->
    <form method="POST" action="addComment.php?kursId=<?= $kursId; ?>">
        <div class="form-group">
            <label for="comment-title">Titel</label>
            <input type="text" id="comment-title" name="comment-title" required>
        </div>
        <div class="form-group">
            <label for="comment-text">Kommentar</label>
            <textarea id="comment-text" name="comment-text" rows="4" required></textarea>
        </div>
        <button type="submit" name="submit-comment">Kommentar absenden</button>
    </form>
</div>

