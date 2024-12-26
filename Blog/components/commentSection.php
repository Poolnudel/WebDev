<?php
// Sicherstellen, dass kursId aus dem GET-Array verfügbar ist
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    echo "<p>Fehler: Ungültige oder fehlende Kurs-ID.</p>";
    return;
}

$kursId = (int)$_GET['kursId']; // Kurs-ID aus der URL

include 'db.php';

// Prüfen, ob ein Kommentar hinzugefügt, bearbeitet oder gelöscht werden soll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'add') {
        // Kommentar hinzufügen
        $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
        $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);
        $userId = $_SESSION['user_id'];

        $sql = "INSERT INTO kommentare (userId, kommentarTitel, kommentarText, kursId) 
                VALUES ('$userId', '$commentTitle', '$commentText', '$kursId')";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Hinzufügen des Kommentars: " . mysqli_error($conn) . "</p>";
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
        }
		
    } elseif ($_POST['action'] === 'delete') {
        // Kommentar löschen
        $commentId = (int)$_POST['comment-id'];

        $sql = "DELETE FROM kommentare WHERE kommentarId = $commentId AND kursId = $kursId";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Löschen des Kommentars: " . mysqli_error($conn) . "</p>";
        } 
    }
}

// Kommentare laden
$sql = "SELECT kommentare.kommentarId, kommentare.userId, nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText 
        FROM kommentare
        JOIN nutzer ON kommentare.userId = nutzer.userId
        WHERE kommentare.kursId = $kursId";

$comments = mysqli_query($conn, $sql);
if (!$comments) {
    echo "Fehler bei der SQL-Abfrage: " . mysqli_error($conn);
    return;
}
?>

<div class="comments-section">
    <h2>Kommentare</h2>

    <!-- Button zum Öffnen des Modals -->
    <button id="open-modal" class="open-modal-button">Kommentar schreiben</button>

    <!-- Kommentare anzeigen -->
    <?php if (mysqli_num_rows($comments) > 0):
        include 'commentTemplate.php'; ?>
    <?php else: ?>
        <p>Keine Kommentare vorhanden.</p>
    <?php endif; ?>
</div>

<?php include 'modal.php'; ?>

<script>
// Modal-Funktionalität
const modal = document.getElementById('comment-modal');
const modalTitle = document.getElementById('modal-title');
const modalAction = document.getElementById('modal-action');
const commentIdInput = document.getElementById('comment-id');
const commentTitleInput = document.getElementById('comment-title');
const commentTextInput = document.getElementById('comment-text');
const openModalButton = document.getElementById('open-modal');
const closeModalButton = document.getElementById('close-modal');

// Öffnen des Modals für neuen Kommentar
if (openModalButton) {
    openModalButton.addEventListener('click', () => {
        modalTitle.textContent = 'Neuen Kommentar schreiben';
        modalAction.value = 'add';
        commentIdInput.value = '';
        commentTitleInput.value = '';
        commentTextInput.value = '';
        modal.style.display = 'block';
    });
}

// Öffnen des Modals für Kommentar bearbeiten
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

// Schließen des Modals
if (closeModalButton) {
    closeModalButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });
}

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

