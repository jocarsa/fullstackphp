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
<!doctype html>
<html>
    <head>
        <style>
            table,form{display:none;}
        </style>
    </head>
    <body>
        <header>
            <button id="insertar">Quiero insertar un cliente</button>
            <button id="listar">Quiero ver los clientes</button>
        </header>
        <main>
            <form method="POST" action="?">
                <?php   
                    $cliente = new Cliente();                               // Creo un cliente vacio para obtener sus columnas
                    $propiedades = get_class_vars(get_class($cliente));     // Obtengo el listado de las propiedades de esa clase
                    foreach($propiedades as $clave=>$valor){                // Para cada una de las propiedades
                        echo '
                            <input 
                                type="text" 
                                name="'.$clave.'" 
                                placeholder="'.$clave.'"
                            >
                        ';                                                  // Creo un campo de formulario
                    }
                ?>
                <input type="submit">
            </form>
            <table border=1>
                <thead>
                    <tr>
                        <?php
                            /////////////////////////////// LISTADO DE REGISTROS ////////////////////////////////
                            $clientevacio = new Cliente();                  // Creo un cliente vacio
                            $propiedades = get_class_vars(get_class($clientevacio));    // Obtengo el listado de las propiedades
                            foreach($propiedades as $clave=>$valor){        // Y para cada propiedad
                                echo '
                                    <th>'.$clave.'</th>
                                ';                                          // Creo una cabecera de columna html
                            }
                        ?>            
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $archivo = file_get_contents("clientes.json");          // Léeme el contenido de clientes.json
                    $coleccion = json_decode($archivo, true);               // Descomponlo a array de PHP para trabajar mejor
                    foreach($coleccion as $objeto){                         // Para cada elemento (originalmente eran objetos)
                        echo '<tr>';                                        // Arranco una fila de tabla html
                        foreach($objeto as $clave=>$valor){                 // Y ahora para cada registro
                            echo '<td>'.$valor.'</td>';                     // Le añado una celda
                        }
                        echo '</tr>';                                       // Y cierro la fila html
                    }
                    ?>
                </tbody>
            </table>

        </main>
    </body>
</html>













