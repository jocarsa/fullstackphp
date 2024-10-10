<?php

    $archivo = file_get_contents("cliente.json");
    $json = json_decode($archivo, true);
    echo $json;
?>