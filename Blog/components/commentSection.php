<?php
// Prüfen, ob kursId übergeben wurde
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    die("Ungültige Kurs-ID.");
}
$kursId = (int)$_GET['kursId'];

// Verarbeitung des Kommentarformulars
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-comment'])) {
    $userId = $_SESSION['user_id']; // Eingeloggter Nutzer
    $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
    $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);

    // Kommentar in die Datenbank speichern
    $sql = "INSERT INTO kommentare (userId, kommentarTitel, kommentarText, kursId) 
            VALUES ('$userId', '$commentTitle', '$commentText', '$kursId')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Kommentar erfolgreich hinzugefügt!');</script>";
    } else {
        echo "<script>alert('Fehler beim Speichern des Kommentars: " . mysqli_error($conn) . "');</script>";
    }
}

// Kommentare aus der Datenbank abrufen
$sql = "SELECT nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText 
        FROM kommentare
        JOIN nutzer ON kommentare.userId = nutzer.userId
        WHERE kommentare.kursId = $kursId
        ORDER BY kommentare.id DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="comments-section">
    <h2>Kommentare</h2>

    <!-- Kommentare anzeigen -->
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($comment = mysqli_fetch_assoc($result)): ?>
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
    <form method="POST">
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
