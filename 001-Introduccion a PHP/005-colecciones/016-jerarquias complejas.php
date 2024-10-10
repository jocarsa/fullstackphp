<?php

    $agenda = [];
    
    $agenda[0]['nombre'] = "Jose Vicente";
    $agenda[0]['email'] = "josevicente@prueba.com";
    $agenda[0]['telefonos'] = [5234535,53253454];

    $agenda[1]['nombre'] = "Juan";
    $agenda[1]['email'] = "juan@prueba.com";
    $agenda[1]['telefonos'] = [354523543,23453543];

    $agenda[2]['nombre'] = "Jorge";
    $agenda[2]['email'] = "jorge@prueba.com";
    $agenda[2]['telefonos'] = [2534535,325434534];
    
    var_dump($agenda);
    echo "<br>";
    echo "La longitud de la agenda es de: ".count($agenda)." elementos";


?>