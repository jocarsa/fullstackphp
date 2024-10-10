<?php

    $archivo = file_get_contents("clientes.json");
    $json = json_decode($archivo, true);
    var_dump($json);
    echo "<br>";
    echo $json[0]['nombre'];
?>