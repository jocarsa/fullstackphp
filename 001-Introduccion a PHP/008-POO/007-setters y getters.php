<?php

    class Persona{
        private $nombre;
        private $edad;
        public function __construct($nuevonombre,$nuevaedad){
            $this->nombre = $nuevonombre;
            $this->edad = $nuevaedad;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nuevonombre){
            $this->nombre = $nuevonombre;
        }
    }
    
    $Persona1 = new Persona("Jose Vicente",46);
    echo $Persona1->getNombre();
    echo "<br>";
    $Persona1->setNombre("Juan");
    echo $Persona1->getNombre();
    echo "<br>";
?>