<?php
    $fehler=array();
    $ergebnis="";

    //Fehlerfinden
    if(count($_POST))
    {
        $_POST["zahl1"]=str_replace(",",".",$_POST["zahl1"]);
        $_POST["zahl2"]=str_replace(",",".",$_POST["zahl2"]);

        if(!is_numeric($_POST["zahl1"]))
        {
            $fehler["zahl1"]="Zahl 1 ist keine Zahl";
        }
        if($_POST["zahl1"]=="")
        {
            $fehler["zahl1"]="Zahl 1 fehlt";
        }

        if(!is_numeric($_POST["zahl2"]))
        {
            $fehler["zahl2"]="Zahl 2 ist keine Zahl";
        }
        if($_POST["zahl2"]=="")
        {
            $fehler["zahl2"]="Zahl 2 fehlt";
        }

        if($_POST["operator"]=="")
        {
            $fehler["operator"]="Operator fehlt";
        }

        if($_POST["operator"]=="/" && $_POST["zahl2"]==0)
        {
            $fehler["operator"]="Division durch 0 ist nicht möglich";
            $fehler["zahl2"]="";
        }
    }

    //Berechnen
    if(count($_POST) && count($fehler)==0)
    {
        if($_POST["operator"]=="+")
        {
            $ergebnis=$_POST["zahl1"]+$_POST["zahl2"];
        }
        elseif($_POST["operator"]=="-")
        {
            $ergebnis=$_POST["zahl1"]-$_POST["zahl2"];
        }
        elseif($_POST["operator"]=="*")
        {
            $ergebnis=$_POST["zahl1"]*$_POST["zahl2"];
        }
        elseif($_POST["operator"]=="/")
        {
            $ergebnis=$_POST["zahl1"]/$_POST["zahl2"];
        }
    }
?>

<html>
    <head>
        <title>Taschenrechner</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="taschenrechner.css">
    </head>
    <body>

        <?php
        print_r($_POST);
        ?>

        <h1>Taschenrechner</h1>
        <form action="taschenrechner.php" method="post">
            <input type="text" name="zahl1" placeholder="Zahl 1" value="<?php if(isset($_POST["zahl1"])) {echo(str_replace(".",",", $_POST["zahl1"]));}?>" class ="<?php if(isset($fehler["zahl1"])) {echo("fehler");} ?>">
            <select name="operator" class ="<?php if(isset($fehler["operator"])) {echo("fehler");} ?>">
                <option value="">bitte wählen</option>
                <option value="+" <?php if(isset($_POST["operator"]) && $_POST["operator"]=="+") {echo("selected");} ?>>+</option>
                <option value="-" <?php if(isset($_POST["operator"]) && $_POST["operator"]=="-") {echo("selected");} ?>>-</option>
                <option value="*" <?php if(isset($_POST["operator"]) && $_POST["operator"]=="*") {echo("selected");} ?>>*</option>
                <option value="/" <?php if(isset($_POST["operator"]) && $_POST["operator"]=="/") {echo("selected");} ?>>/</option>
            </select>
            <input type="text" name="zahl2" placeholder="Zahl 2" value="<?php if(isset($_POST["zahl2"])) {echo(str_replace(".",",", $_POST["zahl2"]));}?>" class ="<?php if(isset($fehler["zahl2"])) {echo("fehler");} ?>">
            <input type="submit" value="Berechnen">

            <?php
            echo(str_replace(".",",", $ergebnis));
            ?>
        </form>

        <?php
        if(count($fehler)>0)
        {
            echo("<div class='fehler'> Es sind Fehler aufgetreten");
            foreach($fehler as $key=>$value)
            {
                if(!$value=="")
                {
                    echo("<li>".$value);
                }
            }
            echo("<div>");
        }
        ?>
    </body>
</html>
