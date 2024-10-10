<?php

    $archivo = fopen("archivo.txt",'r');
    $lineas = fread($archivo,filesize("archivo.txt"));
    $coleccion = explode("\n",$lineas);
    var_dump($coleccion);
    fclose($archivo);
?>