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
    
    public function tabla($tabla){
        $peticion = "SELECT * FROM ".$tabla.";";
        $resultado = mysqli_query($this->conexion, $peticion);
        $tablas = [];
        while($fila = mysqli_fetch_assoc($resultado)){
            $tablas[] = $fila;
        }
        return json_encode($tablas);
    }
    public function eliminar($tabla,$id){
        $peticion = "DELETE FROM ".$tabla." WHERE Identificador = ".$id.";";
        $resultado = mysqli_query($this->conexion, $peticion);
        return '{"resultado":"'.$peticion.'"}';
    }
    
    public function insertar($tabla,$datos){
        
        $columnas = implode(", ", array_keys($datos));
        $valores = implode("', '", array_map([$this->conexion, 'real_escape_string'], array_values($datos)));
        $peticion = "INSERT INTO ".$tabla." (".$columnas.") VALUES ('".$valores."')";
        $resultado = mysqli_query($this->conexion, $peticion);
        echo '{"resultado":"ok"}';
    }
}

$Conexion = new ConexionDB("localhost", "negocio", "negocio", "negocio");

$mysqli = mysqli_connect("localhost", "negocio", "negocio", "negocio") OR die("Algo ha salido mal");
if(isset($_GET['o'])){
    if($_GET['o'] == "listadotablas"){
        echo $Conexion->listadoTablas();
    }
    
    if($_GET['o'] == "tabla"){
        echo $Conexion->tabla($_GET['tabla']);
    }
    
    if($_GET['o'] == "eliminar"){
        echo $Conexion->eliminar($_GET['tabla'],$_GET['id']);
    }
    if($_GET['o'] == "insertar"){
       $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        echo $Conexion->insertar($_GET['tabla'],$datos);
        
    }
}
?>