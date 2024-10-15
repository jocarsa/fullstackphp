<?php

include "Clases/ConexionDB.php";

$Conexion = new ConexionDB(
    "localhost", 
    "negocio", 
    "negocio", 
    "negocio"
);

if(isset($_GET['o'])){
    switch($_GET['o']){
        case "listadotablas":
            echo $Conexion->listadoTablas();
            break;
        case "tabla":
            echo $Conexion->tabla($_GET['tabla']);
            break;
        case "eliminar":
            echo $Conexion->eliminar($_GET['tabla'],$_GET['id']);
            break;
        case "insertar":
            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);
            echo $Conexion->insertar($_GET['tabla'],$datos);
            break;
        case default:
            echo '{"resultado":"ko"}';
            break;
    }
    
    

    
  
}
?>