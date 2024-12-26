<?php
//live zugang
/*
$servername = "localhost";
$username = "gruppe1";
$password = "qSD42Ic!5f";
$dbname = "gruppe1";
*/

//local zugang
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gruppe1";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Prüfen, ob die Verbindung erfolgreich ist
if (!$conn) {
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
}
?>