<?php

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");

$peticion = "
    SELECT 
    lineaspedido.cantidad AS cantidad,
    productos.nombre AS nombre,
    productos.precio AS precio,
    productos.precio * lineaspedido.cantidad AS subtotal
    FROM lineaspedido
    LEFT JOIN pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN productos ON lineaspedido.productos_nombre = productos.Identificador
    WHERE pedidos.Identificador = ".$_GET['id'];
$resultado = mysqli_query($mysqli, $peticion);

$coleccion = [];

while($fila = mysqli_fetch_assoc($resultado)){
    $coleccion[] = $fila;
}

echo json_encode($coleccion);
?>