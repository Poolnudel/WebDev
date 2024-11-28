<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackEnd</title>

    <link rel="stylesheet" href="registrierungsformular.css">
</head>

<body>

    <div class="container">
        <h1>Registrierungsformular</h1>
        <a href="listing.php">Zurück zum Formular</a>

        <form action="listing.php" method="get" style="display:inline;">
            <input type="" text" name="suche" placeholder="Suchbegriff"
                <?php
                if (isset($_GET["suche"])) {
                    echo (" value='" . $_GET["suche"] . "'");
                }
                ?>>
            <?php
            if (isset($_GET["limit"])) {
                echo ("<input type='hidden' name='limit' value='" . $_GET["limit"] . "'>");
            }
            ?>
            <input type="submit" value="Suchen">
        </form>
        <?php
        if (isset($_GET["suche"])) {
            echo ("<form action='listing.php' method='get' style='display:inline;'>");
            if (isset($_GET["limit"])) {
                echo ("<input type='hidden' name='limit' value='" . $_GET["limit"] . "'>");
            }
            echo ("<input type='submit' value='Zurücksetzen'>");
            echo ("</form>");
        }
        ?>
        <table style='width:100%;'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Anrede</th>
                    <th>Name</th>
                    <th>Passwort</th>
                    <th>eMail</th>
                    <th>Hobbies</th>
                    <th>Kurzbeschreibung</th>
                    <th>Portraitbild</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $verbindung = mysqli_connect("localhost", "root", "", "webdev");

                $query = "SELECT * FROM registrierungsformular";
                if (isset($_GET["suche"]) && $_GET["suche"] != "") {
                    $suchbegriffe = explode(" ", $_GET["suche"]);
                    foreach ($suchbegriffe as $key => $value) {
                        if ($key == 0) {
                            $query .= " WHERE ";
                        } else {
                            $query .= " AND ";
                        }
                        $query .= "(name LIKE '%" . $value . "%' 
                                    OR email LIKE '%" . $value . "%' 
                                    OR hobbies LIKE '%" . $value . "%' 
                                    OR kurzbeschreibung LIKE '%" . $value . "%')";
                    }
                    echo ($query);
                }
                $limit = 5;
                if (isset($_GET["limit"])) {
                    $limit = $_GET["limit"];
                }
                $seite = 1;
                if(isset($_GET["seite"])) {
                    $seite = $_GET["seite"];
                }
                if($seite < 1) {
                    $seite = 1;
                }

                $offset = $limit * ($seite - 1);
                
                $query .= " LIMIT " . $limit . " OFFSET " . $offset;
                $ergebnis = mysqli_query($verbindung, $query);
                while ($datensatz = mysqli_fetch_array($ergebnis)) {
                    echo ("
                        <tr>
                            <td>" . $datensatz["id"] . "</td>
                            <td>" . $datensatz["anrede"] . "</td>
                            <td>" . $datensatz["name"] . "</td>
                            <td>" . $datensatz["passwort"] . "</td>
                            <td>" . $datensatz["email"] . "</td>
                            <td>" . implode(", ", unserialize($datensatz["hobbies"])) . "</td>
                            <td>" . $datensatz["kurzbeschreibung"] . "</td>
                            <td>" . $datensatz["portraitbild"] . "</td>
                        </tr>
                        ");
                }
                mysqli_close($verbindung);
                ?>

        </table>

        <form action="listing.php" style="display:inline;"> 
                <?php
                if (isset($_GET["suche"])) {
                    echo ("<input type='hidden' name='suche' value='" . $_GET["suche"] . "'>");
                }
                if (isset($_GET["limit"])) {
                    echo ("<input type='hidden' name='limit' value='" . $_GET["limit"] . "'>");
                }
                echo ("<input type='hidden' name='seite' value='" . ($seite - 1) . "'>");
                echo ("<input type='submit' value='<<'");
                if($seite <= 1) {
                    echo (" disabled ");
                }
                echo(">");
                ?>
        </form>

        <form action="listing.php" method="get" style="display:inline;">
            <?php
            if (isset($_GET["suche"])) {
                echo ("<input type='hidden' name='suche' value='" . $_GET["suche"] . "'>");
            }
            ?>
            <select name="limit" onchange="this.form.submit()">
                <option value="5" <?php if ($limit == 5) {
                                        echo ("selected");
                                    } ?>> 5 </option>
                <option value="10" <?php if ($limit == 10) {
                                        echo ("selected");
                                    } ?>> 10 </option>
                <option value="15" <?php if ($limit == 15) {
                                        echo ("selected");
                                    } ?>> 15 </option>
                <option value="20" <?php if ($limit == 20) {
                                        echo ("selected");
                                    } ?>> 20 </option>
            </select>

        </form>

        <form action="listing.php" style="display:inline;"> 
                <?php
                if (isset($_GET["suche"])) {
                    echo ("<input type='hidden' name='suche' value='" . $_GET["suche"] . "'>");
                }
                if (isset($_GET["limit"])) {
                    echo ("<input type='hidden' name='limit' value='" . $_GET["limit"] . "'>");
                }
                echo ("<input type='hidden' name='seite' value='" . ($seite + 1) . "'>");
                echo ("<input type='submit' value='>>'");
                if ($ergebnis->num_rows < $limit) {
                    echo (" disabled ");
                }
                echo(">");
                ?>
        </form>

    </div>
</body>

</html>