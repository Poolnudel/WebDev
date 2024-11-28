<?php

    $zeit = time();
    echo($zeit."<br><br>");

    $datum = date("d.m.Y",$zeit);
    $uhrzeit = date("H:i:s",$zeit);

    echo("Datum: ".$datum."<br>");
    echo("Uhrzeit: ".$uhrzeit."<br>");

?>