<?php

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");

$peticion = "
    SELECT 
    * FROM vistalineaspedido
    WHERE Identificador = ".$_GET['id'];
$resultado = mysqli_query($mysqli, $peticion);

$coleccion = [];

while($fila = mysqli_fetch_assoc($resultado)){
    $coleccion[] = $fila;
}

echo json_encode($coleccion);
?>