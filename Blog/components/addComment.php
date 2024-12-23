<?php
session_start();
include 'components/db.php'; // Verbindung zur Datenbank herstellen

// Prüfen, ob kursId übergeben wurde
if (!isset($_GET['kursId']) || !is_numeric($_GET['kursId'])) {
    die("Ungültige Kurs-ID.");
}
$kursId = (int)$_GET['kursId'];

// Verarbeitung des Kommentarformulars
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-comment'])) {
    // Prüfen, ob der Benutzer eingeloggt ist
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Bitte melden Sie sich an, um einen Kommentar zu schreiben.');</script>";
        header("Location: logInReg.php");
        exit;
    }

    $userId = $_SESSION['user_id']; // Eingeloggter Nutzer
    $commentTitle = mysqli_real_escape_string($conn, $_POST['comment-title']);
    $commentText = mysqli_real_escape_string($conn, $_POST['comment-text']);

    // Kommentar in die Datenbank speichern
    $sql = "INSERT INTO kommentare (userId, kommentarTitel, kommentarText, kursId) 
            VALUES ('$userId', '$commentTitle', '$commentText', '$kursId')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Kommentar erfolgreich hinzugefügt!');</script>";
        header("Location: blog_detail.php?kursId=$kursId"); // Weiterleitung zurück zur Detailseite
        exit;
    } else {
        echo "<script>alert('Fehler beim Speichern des Kommentars: " . mysqli_error($conn) . "');</script>";
    }
}
?>
