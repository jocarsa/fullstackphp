<?php

    class Persona{
        public $nombre = "Jose Vicente";
        public $edad = 46;
    }

    $Persona1 = new Persona();
    echo $Persona1->nombre;
    echo "<br>";
    $Persona1->nombre = "Juan";
    echo $Persona1->nombre;
    echo "<br>";

?>