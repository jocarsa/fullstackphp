<?php

    class ConexionDB{
        /*/////////////////////////////////// DECLARACIÓN DE PROPIEDADES ///////////////////////////////////////////*/
        
        private $servidor;
        private $usuario;
        private $contrasena;
        private $basededatos;
        private $conexion;
        
        /*/////////////////////////////////// DECLARACIÓN DE PROPIEDADES ///////////////////////////////////////////*/
        
        /*/////////////////////////////////// MÉTODO CONSTRUCTOR ///////////////////////////////////////////*/
        
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
        
        /*/////////////////////////////////// MÉTODO CONSTRUCTOR ///////////////////////////////////////////*/
        
        /*/////////////////////////////////// MÉTODOS DE LA CLASE ///////////////////////////////////////////*/
        
        public function listadoTablas(){//////////////////////////////// MÉTODO DE LISTADO DE TABLAS
            $peticion = "SHOW TABLES";
            $resultado = mysqli_query($this->conexion, $peticion);
            $tablas = [];
            while($fila = mysqli_fetch_assoc($resultado)){
                $tablas[] = $fila;
            }
            return json_encode($tablas);
        }

        public function tabla($tabla){//////////////////////////////// MÉTODO DE CONTENIDO DE UNA TABLA
            
            //////////////////////////////// RESTRICCIONES EXTERNAS /////////////////////
            
            $peticion = "
                SELECT
                    a.TABLE_NAME AS tabla,
                    a.COLUMN_NAME AS columna,
                    a.CONSTRAINT_NAME AS restriccion,
                    a.REFERENCED_TABLE_NAME AS tablareferenciada,
                    a.REFERENCED_COLUMN_NAME AS columnareferenciada
                FROM
                    INFORMATION_SCHEMA.KEY_COLUMN_USAGE a
                WHERE
                    a.REFERENCED_TABLE_NAME IS NOT NULL
                    AND a.TABLE_SCHEMA = '".$this->basededatos."'
                    AND a.TABLE_NAME = '".$tabla."';
            ";                                                                 // Quiero averiguar la estructura de relaciones EXTERNAS de la tabla

            $resultado = mysqli_query($this->conexion, $peticion);              // Lanzo la petición
            $estructura = [];                                                   // Creo un array vacio
            while($fila = mysqli_fetch_assoc($resultado)){                      // Para cada uno de los resultados
                $estructura[] = $fila;                                          // Lo añado al array
            }
            
            //////////////////////////////// LISTADO DE COLUMNAS /////////////////////
            
            $peticion = "
                SHOW COLUMNS FROM ".$tabla.";
            ";                                                                  // Ahora quiero saber qué columnas tiene la tabla
            $resultado = mysqli_query($this->conexion, $peticion);              // Lanzo la petición contra la base de datos
            $columnas = [];                                                     // Creo un arreglo vacío
            while($fila = mysqli_fetch_assoc($resultado)){                      // Para cada uno de los resultados
                $columnas[] = $fila;                                            // Lo añado al array
            }
            
            //////////////////////////////// CREO UNA PETICIÓN CON JOIN DE FORMA DINÁMICA /////////////////////
            
            $peticion = "SELECT ";                                              // Empiezo a crear una peticion
            
            //////////////////////////////// VAMOS CON LOS CAMPOS /////////////////////
            
            foreach($columnas as $clave=>$valor){                               // Para cada una de las columnas
                $externo = false;                                               // En principio cuento con que la relación no es externa
                foreach($estructura as $clave2=>$valor2){                       // Para cada una de las estructuras
                    if($valor2['columna'] == $valor['Field']){                  // comparo si la columna está en la lista de relacions externa
                       $externo = true;                                         // En ese caso declaro que la relacion es externa
                       $tablareferenciada =  $valor2['tablareferenciada'];      // Indico el nombre de la tabla referenciada
                        $columnareferenciada = explode("_",$valor2['columna'])[1];  // Indico el nombre de la columna referenciada
                    }
                }
                if($externo == false){                                          // Si la columna no es externa
                   $peticion .= $tabla.".".$valor['Field'].",";                 // Simplemente ponme el nombre de la columna
                }else{                                                          // Pero si es externa
                    $peticion .= $tablareferenciada.".".$columnareferenciada.",";   // En ese caso ponme el nombre de la columna externa
                }
            }
            $peticion = substr($peticion, 0, -1);
            $peticion .= " FROM ".$tabla." ";
            
            //////////////////////////////// VAMOS CON LOS JOIN /////////////////////
            
            foreach($columnas as $clave=>$valor){                               // PAra cada una de las columnas
                foreach($estructura as $clave2=>$valor2){                       // REpaso cada una de las relaciones externas
                    if($valor2['columna'] == $valor['Field']){                  // Si coinciden
                      $peticion .= "    
                       LEFT JOIN 
                       ".$valor2['tablareferenciada']." 
                       ON ".$tabla.".".$valor['Field']." 
                       =  ".$valor2['tablareferenciada'].".".$valor2['columnareferenciada']."
                       ";                                                       // Preparo la peticion de JOIN
                    }
                } 
            }
            $resultado = mysqli_query($this->conexion, $peticion);
            $tablas = [];
            while($fila = mysqli_fetch_assoc($resultado)){
                $tablas[] = $fila;
            }
            //return json_encode($tablas);
            return $peticion;

        }
        public function eliminar($tabla,$id){//////////////////////////////// MÉTODO DE ELIMINAR REGISTRO DE TABLA
            $peticion = "DELETE FROM ".$tabla." WHERE Identificador = ".$id.";";
            $resultado = mysqli_query($this->conexion, $peticion);
            return '{"resultado":"'.$peticion.'"}';
        }

        public function insertar($tabla,$datos){//////////////////////////////// MÉTODO DE INSERTAR CONTENIDO EN TABLA

            $columnas = implode(", ", array_keys($datos));
            $valores = implode("', '", array_map([$this->conexion, 'real_escape_string'], array_values($datos)));
            $peticion = "INSERT INTO ".$tabla." (".$columnas.") VALUES ('".$valores."')";
            $resultado = mysqli_query($this->conexion, $peticion);
            echo '{"resultado":"ok"}';
        }

        public function actualizar($tabla,$datos){//////////////////////////////// MÉTODO DE ACTUALIZAR UN DATO DE UNA TABLA

            $peticion = "
            UPDATE ".$datos['tabla']." 
            SET ".$datos['columna']."='".$datos['valor']."' 
            WHERE Identificador = ".$datos['identificador'].";
            ";
            $resultado = mysqli_query($this->conexion, $peticion);
            echo '{"resultado":"'.$peticion.'"}';
        }
        
        /*/////////////////////////////////// MÉTODOS DE LA CLASE ///////////////////////////////////////////*/
    }

?>