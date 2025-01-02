<?php
session_start();
include 'components/db.php';
include 'components/header.php';
include 'components/navbar.php';

$searchQuery = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$beitragResults = [];
$kommentareResults = [];

if ($searchQuery) {
    $beitragSql = "SELECT kursTitel, kursText FROM beitrag WHERE kursTitel LIKE '%$searchQuery%' OR kursText LIKE '%$searchQuery%'";
    $beitragResult = mysqli_query($conn, $beitragSql);
    if ($beitragResult && mysqli_num_rows($beitragResult) > 0) {
        while ($row = mysqli_fetch_assoc($beitragResult)) {
            $beitragResults[] = $row;
        }
    }

    $kommentareSql = "SELECT nutzer.userEmail, kommentare.kommentarTitel, kommentare.kommentarText FROM kommentare JOIN nutzer ON kommentare.userId = nutzer.userId WHERE kommentare.kommentarTitel LIKE '%$searchQuery%' OR kommentare.kommentarText LIKE '%$searchQuery%'";
    $kommentareResult = mysqli_query($conn, $kommentareSql);
    if ($kommentareResult && mysqli_num_rows($kommentareResult) > 0) {
        while ($row = mysqli_fetch_assoc($kommentareResult)) {
            $kommentareResults[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suche</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="search-container">
        <form action="suche.php" method="get">
            <input type="text" name="query" placeholder="Suche..." value="<?= htmlspecialchars($searchQuery); ?>">
            <button type="submit">Suchen</button>
        </form>

        <div class="search-results">
            <h2>Beiträge</h2>
            <?php if (!empty($beitragResults)): ?>
                <?php foreach ($beitragResults as $beitrag): ?>
                    <div class="result-box">
                        <h3><?= htmlspecialchars($beitrag['kursTitel']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($beitrag['kursText'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Beiträge gefunden.</p>
            <?php endif; ?>

            <h2>Kommentare</h2>
            <?php if (!empty($kommentareResults)): ?>
                <?php foreach ($kommentareResults as $kommentar): ?>
                    <div class="result-box">
                        <h3><?= htmlspecialchars($kommentar['kommentarTitel']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($kommentar['kommentarText'])); ?></p>
                        <p><em><?= htmlspecialchars($kommentar['userEmail']); ?></em></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Kommentare gefunden.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>
</html>
