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
        
    public function actualizar($tabla,$datos){
        
        
        $peticion = "
        UPDATE ".$datos['tabla']." 
        SET ".$datos['columna']."='".$datos['valor']."' 
        WHERE Identificador = ".$datos['identificador'].";
        ";
        $resultado = mysqli_query($this->conexion, $peticion);
        echo '{"resultado":"'.$peticion.'"}';
    }
}

?>