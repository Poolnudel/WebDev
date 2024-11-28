<?php 

//Datenbankverbindung herstellen
$verbindung=mysqli_connect("localhost","root","","webdev");
// print_r($verbindung);



//Datenbankabfrage INSERT
// $query="INSERT into test (bezeichnung) VALUES ('".time()."')";

//Datenbankabfrage DELETE
// $query="DELETE from test where id=13";

//Datenbankabfrage UPDATE
// $query="UPDATE test set bezeichnung='ich wurde geändert' where id=14";


//Datenbankabfrage Execute
// mysqli_query($verbindung,$query);


//Datenbankabfrage SELECT
$query="SELECT * from test";
$ergebnis=mysqli_query($verbindung,$query);
while($datensatz=mysqli_fetch_array($ergebnis))
{
    echo("<li>");
    print_r($datensatz);
}



//Datenbankverbindung schließen
mysqli_close($verbindung);
?>
