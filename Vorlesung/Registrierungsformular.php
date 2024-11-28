<?php
if(count($_POST)>0)
{
    if(isset($_POST["agb"]))
    {
        $endung=explode(".",$_FILES["bild"]["name"]);
        $dateiname=time()."_".rand(10000,99999).".".$endung[count($endung)-1];
        move_uploaded_file($_FILES["bild"]["tmp_name"], "bilder/" .$dateiname);

        $formularunterdruecken=1;
        $verbindung=mysqli_connect("localhost","root","","webdev");

        if($_POST["neues_hobby"]!="")
        {
            $query="INSERT into hobbies (hobby) VALUES ('".$_POST["neues_hobby"]."')";
            mysqli_query($verbindung,$query);
            $_POST["hobbies"] [mysqli_insert_id($verbindung)] = "on";
        }

        $hobbyvorlagen=array();
        $query="SELECT * FROM hobbies";
        $ergebnis=mysqli_query($verbindung,$query);
        while($datensatz=mysqli_fetch_array($ergebnis))
        {
            $hobbyvorlagen[$datensatz["id"]]=$datensatz["hobby"];
        }

        $hobbies=array();
        foreach($_POST["hobbies"] as $hobbyid=>$on)
        {
            $hobbies[$hobbyid]=$hobbyvorlagen[$hobbyid];
        }
        $query="INSERT into registrierungsformular (name,passwort,email,anrede,portraitbild,kurzbeschreibung, hobbies) VALUES ('".$_POST["name"]."','".$_POST["passwort"]."','".$_POST["email"]."','".$_POST["anrede"]."','".$dateiname."','".$_POST["kurzbeschreibung"]."','".serialize($hobbies)."')";
        mysqli_query($verbindung,$query);
        // $person=mysqli_insert_id($verbindung);
        // foreach($_POST["hobbies"] as $key=>$value)
        // {
        //     $query="INSERT into matching (person,hobby) VALUES (".$person.",".$key.")";
        //     mysqli_query($verbindung,$query);
        // }

        mysqli_close($verbindung);

        //Erfolgsmeldung

        //Hobbies in relationstabelle eintragen last_insert_id
    }
    else
    {
        $agbfehler=1;
    }
}
?>

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

            <?php
            if(!isset($formularunterdruecken))
            {
            ?>
            <form action="registrierungsformular.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="800000000">

                <div class="Zeile">
                    <label for="name" class="merkmal">Dein Vor- und Nachname</label>
                    <input type="text" name="name" id="name" placeholder="Vor- und Nachname" class="eingabefeld"
                    <?php if(isset($_POST['name'])) {echo("value='".$_POST["name"]."'");} ?>
                    >
    
                </div>
    
                <div class="Zeile">
                    <label for="passwort" class="merkmal">Dein Passwortwunsch</label>
                    <input type="password" name="passwort" id="passwort" class="eingabefeld"
                    <?php if(isset($_POST['passwort'])) {echo("value='".$_POST["passwort"]."'");} ?>
                    >
                </div>
    
                <div class="Zeile">
                    <label for="email" class="merkmal">Deine E-Mail Adresse</label>
                    <input type="text" name="email" id="email" placeholder="max@mustermann.com" class="eingabefeld"
                    <?php if(isset($_POST['email'])) {echo("value='".$_POST["email"]."'");} ?>
                    >
                </div>
    
                <div class="Zeile">

                    <label for="anrede_h" class="merkmal">Deine Anrede</label>

                    <div class="Eingabefeld">

                        <input type="radio" name="anrede" id="anrede_m" value="m" 
                        <?php if(isset($_POST['anrede']) && $_POST["anrede"]=="m") {echo("checked='checked'");} ?>
                        >
                        <label for="anrede_m">Herr</label>
    
                        <input type="radio" name="anrede" id="anrede_f" value="f"
                        <?php if(isset($_POST['anrede']) && $_POST["anrede"]=="f") {echo("checked='checked'");} ?>
                        >
                        <label for="anrede_f">Frau</label>
    
                        <input type="radio" name="anrede" id="anrede_h" value="h"
                        <?php if(!isset($_POST['anrede']) || (isset($_POST['anrede']) && $_POST["anrede"]=="h")) {echo("checked='checked'");} ?>
                        >
                        <label for="anrede_h">Hallo</label>
        
                    </div>
    
                </div>
    
                <div class="Zeile">
                    <label for="bild" class="merkmal">Dein Profilbild</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="800000000">
                    <input type="file" name="bild" id="bild" class="eingabefeld">
                </div>

                <div class="Zeile">
                    <label for="hobbies" class="merkmal">Deine Hobbies</label>

                    <div class="eingabefeld" style="height:4.5em;border:1px solid #aaa;overflow-x:clip;overflow-y:scroll;">
                    
                    <input type="text" name="neues_hobby" placeholder='Neues Hobby' 
                    value='<?php if(isset($_POST["neues_hobby"])) {echo($_POST["neues_hobby"]);} ?>'>

                        <?php
                        $verbindung=mysqli_connect("localhost","root","","webdev");
                        $query="SELECT * FROM hobbies ORDER BY hobby ASC";

                        $ergebnis=mysqli_query($verbindung,$query);
                        while($datensatz=mysqli_fetch_array($ergebnis))
                        {
                            echo("
                            <div>
                            <input type='checkbox' name='hobbies[".$datensatz["id"]."]' id='".$datensatz["hobby"]."'");
                            if(isset($_POST["hobbies"] [$datensatz["id"]])) {echo("checked='checked'");}
                            echo("><label for='".$datensatz["hobby"]."'>".$datensatz["hobby"]."</label>
                            </div>");
                        }
                        mysqli_close($verbindung);
                        ?>

                    </div>
                </div>

                <div class="Zeile">
                    <label for="kurzbeschreibung" class="merkmal">Erzähl' etwas von dir</label>
                    <textarea name="kurzbeschreibung" id="kurzbeschreibung" class="eingabefeld"><?php if(isset($_POST['kurzbeschreibung'])) {echo($_POST["kurzbeschreibung"]);} ?></textarea>
                </div>

                <div class="Zeile">
                    <label for="agb" class="merkmal" class="merkmal">Bitte akzeptiere unsere AGBs</label>
                    <div class="eingabefeld <?php if(isset($agbfehler)) {echo(" fehler");}?>">
                        <input type="checkbox" name="agb" id="agb">
                        <label for="agb">AGB akzeptieren</label>
                    </div>
                
                </div>

                <div class="Zeile">

                    <?php 
                    if(isset($agbfehler)) 
                    {
                        echo("<div class='fehler'>Bitte akzeptiere unsere AGBs</div>");
                    }
                    ?>

                    <div class="merkmal">
                        <input type="reset" value="Zurücksetzen" class="button" style="float:left;">
                    </div>

                    <div class="merkmal">
                        <input type="submit" value="Absenden" class="button" style="float:right;">
                    </div>

                </div>

            </form>
            <?php
            }
            ?>

        </div>

    </body>

</html>