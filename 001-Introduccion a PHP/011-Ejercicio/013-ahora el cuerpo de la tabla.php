<?php
    /////////////////////////////// CREACIÓN DE UNA CLASE ////////////////////////////////
    class Cliente{                                              // Creo un modelo de datos de un cliente
        public $nombre;                                         // Le pongo una serie de propiedades
        public $apellidos;
        public $email;
        public $telefono;
        public $direccion;
        public $pais;
    }
?>
<?php
    /////////////////////////////// INSERCIÓN DE REGISTROS ////////////////////////////////
    if(isset($_POST['nombre'])){                                // En el caso de que se esté enviando el formulario
        
        $archivo = file_get_contents("clientes.json");          // Léeme el contenido de clientes.json
        $coleccion = json_decode($archivo, true);               // Descomponlo a array de PHP para trabajar mejor
        
        $nuevocliente = new Cliente();                          // Creo una nueva instancia de un cliente vacio
        foreach($_POST as $clave=>$valor){                      // Y para cada uno de los campos que vienen del formulario
            $nuevocliente->$clave = $valor;                     // Pon la propiedad de la clase que corresponde con ese campo
        }
        array_push($coleccion,$nuevocliente);                   // Truco sucio para añadir un nuevo elemento a la coleccion
            
        $json = json_encode($coleccion, JSON_PRETTY_PRINT);     // Ahora convierto de vuelta array de php a json
        file_put_contents("clientes.json",$json);               // Y guardo el json en la base de datos
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
<table border=1>
    <thead>
        <tr>
            <?php
                /////////////////////////////// LISTADO DE REGISTROS ////////////////////////////////
                $clientevacio = new Cliente();
                $propiedades = get_class_vars(get_class($clientevacio));
                foreach($propiedades as $clave=>$valor){
                    echo '
                        <th>'.$clave.'</th>
                    ';
                }
            ?>            
        </tr>
    </thead>
    <tbody>
        <?php
            
        $archivo = file_get_contents("clientes.json");          // Léeme el contenido de clientes.json
        $coleccion = json_decode($archivo, true);               // Descomponlo a array de PHP para trabajar mejor
        foreach($coleccion as $objeto){
            var_dump($objeto);
        }
        ?>
    </tbody>
</table>













