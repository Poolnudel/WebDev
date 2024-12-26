<?php
// Sicherstellen, dass kursId aus dem GET-Array verfügbar ist
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    echo "<p>Fehler: Ungültige oder fehlende Kurs-ID.</p>";
    return;
}

$kursId = (int)$_GET['kursId']; // Kurs-ID aus der URL

include 'db.php';

// Debugging: Kurs-ID anzeigen
echo "DEBUG: Kurs-ID = $kursId<br>";

// Prüfen, ob ein Kommentar hinzugefügt, bearbeitet oder gelöscht werden soll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    echo "DEBUG: POST-Daten empfangen, Aktion = " . $_POST['action'] . "<br>";

    if ($_POST['action'] === 'add') {
        // Kommentar hinzufügen
        $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
        $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);
        $userId = $_SESSION['user_id'];

        $sql = "INSERT INTO kommentare (userId, kommentarTitel, kommentarText, kursId) 
                VALUES ('$userId', '$commentTitle', '$commentText', '$kursId')";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Hinzufügen des Kommentars: " . mysqli_error($conn) . "</p>";
        } else {
            echo "DEBUG: Kommentar erfolgreich hinzugefügt<br>";
        }
    } elseif ($_POST['action'] === 'edit') {
        // Kommentar bearbeiten
        $commentId = (int)$_POST['comment-id'];
        $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
        $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);

        $sql = "UPDATE kommentare 
                SET kommentarTitel = '$commentTitle', kommentarText = '$commentText' 
                WHERE kommentarId = $commentId AND kursId = $kursId";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Bearbeiten des Kommentars: " . mysqli_error($conn) . "</p>";
        } else {
            echo "DEBUG: Kommentar erfolgreich bearbeitet<br>";
        }
    } elseif ($_POST['action'] === 'delete') {
        // Kommentar löschen
        $commentId = (int)$_POST['comment-id'];

        $sql = "DELETE FROM kommentare WHERE kommentarId = $commentId AND kursId = $kursId";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Löschen des Kommentars: " . mysqli_error($conn) . "</p>";
        } else {
            echo "DEBUG: Kommentar erfolgreich gelöscht<br>";
        }
    }
}

// Kommentare laden
$sql = "SELECT kommentare.kommentarId, kommentare.userId, nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText 
        FROM kommentare
        JOIN nutzer ON kommentare.userId = nutzer.userId
        WHERE kommentare.kursId = $kursId";

echo "DEBUG: SQL-Abfrage vorbereitet<br>";

$comments = mysqli_query($conn, $sql);
if (!$comments) {
    echo "Fehler bei der SQL-Abfrage: " . mysqli_error($conn);
    return;
}
echo "DEBUG: Kommentare geladen, Anzahl = " . mysqli_num_rows($comments) . "<br>";
?>

<div class="comments-section">
    <h2>Kommentare</h2>

    <!-- Button zum Öffnen des Modals -->
    <button id="open-modal" class="open-modal-button">Kommentar schreiben</button>

    <!-- Kommentare anzeigen -->
    <?php if (mysqli_num_rows($comments) > 0): ?>
        <?php while ($comment = mysqli_fetch_assoc($comments)): ?>
            <div class="comment">
                <p class="comment-author"><?= htmlspecialchars($comment['userEmail']); ?></p>
                <p class="comment-title"><?= htmlspecialchars($comment['kommentarTitel']); ?></p>
                <p class="comment-text"><?= nl2br(htmlspecialchars($comment['kommentarText'])); ?></p>

                <?php if ($_SESSION['user_id'] == $comment['userId']): ?>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="comment-id" value="<?= $comment['kommentarId']; ?>">
                        <button type="submit" class="delete-comment-button">Löschen</button>
                    </form>
                    <button class="edit-comment-button" 
                            data-id="<?= $comment['kommentarId']; ?>" 
                            data-title="<?= htmlspecialchars($comment['kommentarTitel']); ?>" 
                            data-text="<?= htmlspecialchars($comment['kommentarText']); ?>">
                        Bearbeiten
                    </button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Keine Kommentare vorhanden.</p>
    <?php endif; ?>
</div>

<!-- Modal-Fenster -->
<div id="comment-modal" class="modal">
    <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h3 id="modal-title">Neuen Kommentar schreiben</h3>
        <form method="POST">
            <input type="hidden" name="action" value="add" id="modal-action">
            <input type="hidden" name="comment-id" id="comment-id">
            <div class="form-group">
                <label for="comment-title">Titel</label>
                <input type="text" id="comment-title" name="comment-title" required>
            </div>
            <div class="form-group">
                <label for="comment-text">Kommentar</label>
                <textarea id="comment-text" name="comment-text" rows="4" required></textarea>
            </div>
            <button type="submit">Speichern</button>
        </form>
    </div>
</div>

<script>
    // Elemente für das Modal
    const modal = document.getElementById('comment-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalAction = document.getElementById('modal-action');
    const commentIdInput = document.getElementById('comment-id');
    const commentTitleInput = document.getElementById('comment-title');
    const commentTextInput = document.getElementById('comment-text');
    const openModalButton = document.getElementById('open-modal');
    const closeModalButton = document.getElementById('close-modal');

    // Modal für neuen Kommentar öffnen
    openModalButton.addEventListener('click', () => {
        modalTitle.textContent = 'Neuen Kommentar schreiben';
        modalAction.value = 'add';
        commentIdInput.value = '';
        commentTitleInput.value = '';
        commentTextInput.value = '';
        modal.style.display = 'block';
    });

    // Modal für Kommentar bearbeiten öffnen
    document.querySelectorAll('.edit-comment-button').forEach(button => {
        button.addEventListener('click', () => {
            modalTitle.textContent = 'Kommentar bearbeiten';
            modalAction.value = 'edit';
            commentIdInput.value = button.dataset.id;
            commentTitleInput.value = button.dataset.title;
            commentTextInput.value = button.dataset.text;
            modal.style.display = 'block';
        });
    });

    // Modal schließen
    closeModalButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Schließen des Modals, wenn außerhalb geklickt wird
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Bestätigung vor dem Löschen
    document.querySelectorAll('.delete-comment-button').forEach(button => {
        button.addEventListener('click', (event) => {
            if (!confirm('Möchten Sie diesen Kommentar wirklich löschen?')) {
                event.preventDefault();
            }
        });
    });
</script>

<style>
/* Modal-Styling */
.modal {
    display: none; /* Modal ist initial ausgeblendet */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Halbtransparenter Hintergrund */
    z-index: 1000; /* Modal über anderen Inhalten */
}

.modal-content {
    position: relative;
    margin: 10% auto;
    padding: 1rem;
    background-color: white;
    width: 50%;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
}

.open-modal-button, .delete-comment-button, .edit-comment-button {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background-color: #294936;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.open-modal-button:hover, .delete-comment-button:hover, .edit-comment-button:hover {
    background-color: #3E6259;
}

.delete-comment-button {
    background-color: #d9534f;
}

.delete-comment-button:hover {
    background-color: #c9302c;
}
</style>
