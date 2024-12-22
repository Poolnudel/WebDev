<?php
$conn = mysqli_connect("localhost", "root", "", "blogbase");

// Prüfen, ob die Verbindung erfolgreich ist
if (!$conn) {
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
}
?>