<?php

    $agenda = [];
    
    $agenda[0]['nombre'] = "Jose Vicente";
    $agenda[0]['email'] = "josevicente@prueba.com";
    $agenda[0]['telefono'] = 5234535;

    $agenda[1]['nombre'] = "Juan";
    $agenda[1]['email'] = "juan@prueba.com";
    $agenda[1]['telefono'] = 64564546;

    $agenda[2]['nombre'] = "Jorge";
    $agenda[2]['email'] = "jorge@prueba.com";
    $agenda[2]['telefono'] = 5234535;
    
    var_dump($agenda);
    echo "<br>";
    echo "La longitud de la agenda es de: ".count($agenda)." elementos";


?>