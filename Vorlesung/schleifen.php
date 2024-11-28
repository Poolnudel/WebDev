<?php

    echo("foreach-Schleife <br>");

    $array=array("A","B","C","D");

    foreach($array as $key => $value)
    {
        echo("<li>".$key."=>".$value);
    }

    echo("<br> for-Schleife <br>");

    for($i=0;$i<count($array);$i++)
    {
        echo("<li>".$i."=>".$array[$i]);
    }

    echo("<br> while-Schleife <br>");

    $i=0;
    while($i<count($array))
    {
        echo("<li>".$i."=>".$array[$i]);
        $i++;
    }

?>