<?php

    $archivo = fopen("archivo.txt",'r');
    $lineas = fread($archivo,filesize("archivo.txt"));
    echo $lineas;
    fclose($archivo);
?>