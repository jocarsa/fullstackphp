<?php

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");
if(isset($_GET['o'])){
    if($_GET['o'] == "listadotablas"){
        $peticion = "SHOW TABLES";
        $resultado = mysqli_query($mysqli, $peticion);

        $tablas = [];

        while($fila = mysqli_fetch_assoc($resultado)){
            $tablas[] = $fila;
        }

        echo json_encode($tablas);
    }
    
    
}
?>