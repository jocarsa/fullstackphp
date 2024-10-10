<?php

    $archivo = fopen("archivo.txt",'r');
    $lineas = fread($archivo,filesize("archivo.txt"));
    $coleccion = explode("\n",$lineas);
    foreach($coleccion as $linea){
        echo $linea."<br>";
    }
    fclose($archivo);
?>