<?php

    $diadelasemana = "longaniza";

    switch($diadelasemana){
        case "lunes":
            echo "Es el peor día de la semana";
            break;
        case "martes":
            echo "Es el segundo peor día de la semana";
            break;
        case "miercoles":
            echo "It's wednesday, my dudes";
            break;
        case "jueves":
            echo "Ya casi estamos a viernes";
            break;
        case "viernes":
            echo "Por fin es viernes";
            break;
        case "sabado":
            echo "Es el mejor día de la semana";
            break;
        case "domingo":
            echo "Parece mentira que mañana ya sea lunes";
            break;
        default:
            echo "No sé que has escrito";
            break;
    }
?>