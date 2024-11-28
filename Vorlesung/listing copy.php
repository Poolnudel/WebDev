<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrierungsformular</title>

        <link rel="stylesheet" href="registrierungsformular.css">
    </head>

    <body>
    
        <div class="container">
            <h1>Registrierungsformular</h1>

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
                    $verbindung=mysqli_connect("localhost","root","","webdev");

                    $query="SELECT registrierungsformular.id, registrierungsformular.passwort, registrierungsformular.email, registrierungsformular.anrede, registrierungsformular.name, registrierungsformular.portraitbild, registrierungsformular.kurzbeschreibung, hobbies.hobby FROM registrierungsformular, matching, hobbies WHERE registrierungsformular.id=matching.person AND matching.hobby=hobbies.id;";
                    $ergebnis=mysqli_query($verbindung,$query);
                    while($datensatz=mysqli_fetch_array($ergebnis))
                    {
                        $daten[$datensatz["id"]]["name"]=$datensatz["name"];
                        $daten[$datensatz["id"]]["anrede"]=$datensatz["anrede"];
                        $daten[$datensatz["id"]]["passwort"]=$datensatz["passwort"];
                        $daten[$datensatz["id"]]["email"]=$datensatz["email"];
                        $daten[$datensatz["id"]]["kurzbeschreibung"]=$datensatz["kurzbeschreibung"];
                        $daten[$datensatz["id"]]["portraitbild"]=$datensatz["portraitbild"];
                        $daten[$datensatz["id"]]["hobbies"][]=$datensatz["hobby"];
                    }
                    mysqli_close($verbindung);

                    foreach($daten as $kundenid=>$kundenwerte)
                    {
                        echo("
                        <tr>
                            <td>".$kundenwerte["id"]."</td>
                            <td>".$kundenwerte["anrede"]."</td>
                            <td>".$kundenwerte["name"]."</td>
                            <td>".$kundenwerte["passwort"]."</td>
                            <td>".$kundenwerte["email"]."</td>
                            <td>".implode(", ",$kundenwerte["hobbies"])."</td>
                            <td>".$kundenwerte["kurzbeschreibung"]."</td>
                            <td>".$kundenwerte["portraitbild"]."</td>
                        </tr>
                        ");
                    }
                    ?>                

            </table>

        </div>
    </body>
</html>