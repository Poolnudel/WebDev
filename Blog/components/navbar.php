<?php
//require_once 'db.php';
include 'db.php';

// Funktion, um die Kurse aus der Datenbank zu laden
function getCourses($conn) {
    $sql = "SELECT kurs_id, kurs_kurz_name FROM kurse";
    $result = $conn->query($sql);
    $courses = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = [
                'id' => $row['kurs_id'],
                'name' => $row['kurs_kurz_name']
            ];
        }
    }
    return $courses;
}

$courses = getCourses($conn);
?>

<nav>
    <ul>
        <!-- Link zur Homepage -->
        <li><a href="index.php">Home</a></li>

        <!-- Login/Logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>

        <!-- Dynamische Liste der Kurse -->
        <li class="dropdown">
            <a href="#">Kurse</a>
            <ul class="dropdown-menu">
                <?php foreach ($courses as $course): ?>
                    <li><a href="blog_detail.php?kursId=<?php echo $course['id']; ?>"><?php echo $course['name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
    </ul>
</nav>
