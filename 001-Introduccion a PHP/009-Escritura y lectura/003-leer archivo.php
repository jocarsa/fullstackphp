<?php

    $archivo = fopen("archivo.txt",'r');
    $lineas = fread($archivo,10);
    echo $lineas;

?>