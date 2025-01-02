<?php
//require_once 'db.php';
include 'db.php';

// Funktion, um die Kurse aus der Datenbank zu laden
function getCourses($conn) {
    $sql = "SELECT beitrag.kursId, beitrag.kursTitel FROM beitrag";
    $result = $conn->query($sql);
    $courses = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = [
                'id' => $row['kursId'],
                'name' => $row['kursTitel']
            ];
        }
    }
    return $courses;
}

$courses = getCourses($conn);
?>

<nav class="hero">
    <ul class="nav">
        <!-- Link zur Homepage -->
        <li><a href="index.php">Home</a></li>

        <!-- Dynamische Liste der Kurse -->
        <li class="dropdown">
            <a href="#">Kurse</a>
            <ul class="dropdown-menu">
                <?php foreach ($courses as $course): ?>
                    <li><a href="blog_detail.php?kursId=<?php echo $course['id']; ?>"><?php echo $course['name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- Suchformular -->
        <li>
            <form action="suche.php" method="get">
                <input type="text" name="query" placeholder="Suche...">
                <button type="submit">Suchen</button>
            </form>
        </li>

         <!-- Login/Logout -->
         <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
