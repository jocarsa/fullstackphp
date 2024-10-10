<?php

    $archivo = file_get_contents("cliente.json");
    $json = json_decode($archivo, true);
    var_dump($json);
    echo "<br>";
    echo $json['nombre'];
?>