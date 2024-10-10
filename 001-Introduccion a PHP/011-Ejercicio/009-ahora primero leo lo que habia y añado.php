<?php
    class Cliente{
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public $direccion;
        public $pais;
    }
    if(isset($_POST['nombre'])){
        
        $archivo = file_get_contents("clientes.json");
        $coleccion = json_decode($archivo, true);
        
        $nuevocliente = new Cliente();
        foreach($_POST as $clave=>$valor){
            $nuevocliente->$clave = $valor;
        }
        $coleccion[] = $nuevocliente;
            
        $json = json_encode($coleccion, JSON_PRETTY_PRINT);
        file_put_contents("clientes.json",$json);
    }

?>
<form method="POST" action="?">
    <?php   
        $cliente = new Cliente();
        $propiedades = get_class_vars(get_class($cliente));
        foreach($propiedades as $clave=>$valor){
            echo '
                <input type="text" name="'.$clave.'" placeholder="'.$clave.'">
            ';
        }
    ?>
    <input type="submit">
</form>