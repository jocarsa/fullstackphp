<?php

class ConexionDB{
    private $servidor;
    private $usuario;
    private $contrasena;
    private $basededatos;
    private $conexion;
    public function __construct(
        $nuevoservidor,
        $nuevousuario,
        $nuevacontrasena,
        $nuevabd,
    ){
        $this->servidor = $nuevoservidor;
        $this->usuario = $nuevousuario;
        $this->contrasena = $nuevacontrasena;
        $this->basededatos = $nuevabd;
        $this->conexion = mysqli_connect(
            $this->servidor, 
            $this->usuario, 
            $this->contrasena, 
            $this->basededatos
        ) OR die("Algo ha salido mal");
    }
    
    public function listadoTablas(){
        $peticion = "SHOW TABLES";
        $resultado = mysqli_query($this->conexion, $peticion);
        $tablas = [];
        while($fila = mysqli_fetch_assoc($resultado)){
            $tablas[] = $fila;
        }
        return json_encode($tablas);
    }
    
    
}

$Conexion = new ConexionDB("localhost", "negocio", "negocio", "negocio");

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");
if(isset($_GET['o'])){
    if($_GET['o'] == "listadotablas"){
        echo $Conexion->listadoTablas();
    }
    
    if($_GET['o'] == "tabla"){
        $peticion = "SELECT * FROM ".$_GET['tabla'].";";
        $resultado = mysqli_query($mysqli, $peticion);

        $tablas = [];

        while($fila = mysqli_fetch_assoc($resultado)){
            $tablas[] = $fila;
        }

        echo json_encode($tablas);
    }
    
    if($_GET['o'] == "eliminar"){
        $peticion = "DELETE FROM ".$_GET['tabla']." WHERE Identificador = ".$_GET['id'].";";
        echo '{"resultado":"ok"}';
        $resultado = mysqli_query($mysqli, $peticion);
    }
    if($_GET['o'] == "insertar"){
       
        $json = file_get_contents('php://input');
         $datos = json_decode($json, true);
        $columnas = implode(", ", array_keys($datos));
        $valores = implode("', '", array_map([$mysqli, 'real_escape_string'], array_values($datos)));
        $peticion = "INSERT INTO ".$_GET['tabla']." (".$columnas.") VALUES ('".$valores."')";
        $resultado = mysqli_query($mysqli, $peticion);
        echo '{"resultado":"ok"}';
        
    }
}
?>