<?php

    $archivo = fopen("archivo.txt",'w');
    fwrite($archivo,"Esto es un texto que escribo desde PHP");
    fclose($archivo);

?>