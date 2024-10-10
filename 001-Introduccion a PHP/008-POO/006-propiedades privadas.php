<?php

    class Persona{
        private $nombre;
        private $edad;
        public function __construct($nuevonombre,$nuevaedad){
            $this->nombre = $nuevonombre;
            $this->edad = $nuevaedad;
        }
    }
    
    $Persona1 = new Persona("Jose Vicente",46);
    echo $Persona1->nombre;
    echo "<br>";


?>