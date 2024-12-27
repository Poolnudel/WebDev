<?php
// Sicherstellen, dass kursId aus dem GET-Array verfügbar ist
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    echo "<p>Fehler: Ungültige oder fehlende Kurs-ID.</p>";
    return;
}

$kursId = (int)$_GET['kursId']; // Kurs-ID aus der URL

include 'db.php';

function handleImageUpload($file, $uploadDir = 'images/') {
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
        $fileType = mime_content_type($file['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception('Ungültiger Dateityp. Erlaubt sind PNG, JPEG und GIF.');
        }

        $uploadDir = __DIR__ . '/' . trim($uploadDir, '/') . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception('Fehler beim Speichern des Bildes.');
        }

        return 'images/' . $fileName; // Relativer Pfad zurückgeben
    }
    return null; // Keine Datei hochgeladen
}

// Prüfen, ob ein Kommentar hinzugefügt, bearbeitet oder gelöscht werden soll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
        $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);
        $userId = $_SESSION['user_id'];
        $imagePath = null;

        try {
            $imagePath = handleImageUpload($_FILES['comment-image']);
        } catch (Exception $e) {
            echo "<p>Fehler: " . $e->getMessage() . "</p>";
            return;
        }

        $sql = "INSERT INTO kommentare (userId, kommentarTitel, kommentarText, kursId, kommentarBild) 
                VALUES ('$userId', '$commentTitle', '$commentText', '$kursId', '$imagePath')";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Hinzufügen des Kommentars: " . mysqli_error($conn) . "</p>";
        }
    } elseif ($_POST['action'] === 'edit') {
        $commentId = (int)$_POST['comment-id'];
		$commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
		$commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);
		$imagePath = null;

		// Prüfen, ob ein neues Bild hochgeladen wurde
		try {
			$newImagePath = handleImageUpload($_FILES['comment-image']);
			if ($newImagePath) {
				$imagePath = $newImagePath;
				// Optional: Altes Bild aus der Datenbank abrufen und löschen
				$oldImageSql = "SELECT kommentarBild FROM kommentare WHERE kommentarId = $commentId AND kursId = $kursId";
				$result = mysqli_query($conn, $oldImageSql);
				if ($result && $row = mysqli_fetch_assoc($result)) {
					$oldImagePath = __DIR__ . '/' . $row['kommentarBild'];
					if (file_exists($oldImagePath)) {
						unlink($oldImagePath); // Altes Bild löschen
					}
				}
			}
		} catch (Exception $e) {
			echo "<p>Fehler: " . $e->getMessage() . "</p>";
			return;
		}
		// Update-Abfrage
		$sql = "UPDATE kommentare 
				SET kommentarTitel = '$commentTitle', kommentarText = '$commentText'";
		if ($imagePath) {
			$sql .= ", kommentarBild = '$imagePath'";
		}
		$sql .= " WHERE kommentarId = $commentId AND kursId = $kursId";
		if (!mysqli_query($conn, $sql)) {
			echo "<p>Fehler beim Bearbeiten des Kommentars: " . mysqli_error($conn) . "</p>";
		}
    } elseif ($_POST['action'] === 'delete') {
        $commentId = (int)$_POST['comment-id'];
        $sql = "DELETE FROM kommentare WHERE kommentarId = $commentId AND kursId = $kursId";

        if (!mysqli_query($conn, $sql)) {
            echo "<p>Fehler beim Löschen des Kommentars: " . mysqli_error($conn) . "</p>";
        }
    }
}

// Kommentare laden
$sql = "SELECT kommentare.kommentarId, kommentare.userId, nutzer.userName, nutzer.userEmail, kommentare.kommentarTitel, 
        kommentare.kommentarText, kommentare.kommentarBild 
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
    
    <div class="comment-button-container">
        <!-- Button zum Öffnen des Modals -->
        <button id="open-modal" class="open-modal-button">Kommentar schreiben</button>
    </div>

    <!-- Kommentare anzeigen -->
    <?php if (mysqli_num_rows($comments) > 0): ?>
        <?php include 'commentTemplate.php'; ?>
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

// Modal öffnen
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

// Modal schließen
if (closeModalButton) {
    closeModalButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });
}

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

// Modal bei Klick außerhalb schließen
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

document.querySelectorAll('.delete-comment-button').forEach(button => {
    button.addEventListener('click', (event) => {
        if (!confirm('Möchten Sie diesen Kommentar wirklich löschen?')) {
            event.preventDefault();
        }
    });
});
</script>
