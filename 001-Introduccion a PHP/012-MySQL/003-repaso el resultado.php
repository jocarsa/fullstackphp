<?php

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");

$peticion = "SELECT * FROM clientes";
$resultado = mysqli_query($mysqli, $peticion);

while($fila = mysqli_fetch_array($resultado)){
    var_dump($fila);
}

?>