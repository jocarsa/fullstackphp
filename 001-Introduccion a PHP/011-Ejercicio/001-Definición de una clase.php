<?php
    class Cliente{
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public function __construct(
            $nuevonombre,
            $nuevaedad,
            $nuevoemail,
            $nuevotelefono,
        ){
            $this->nombre = $nuevonombre;
            $this->edad = $nuevaedad;
            $this->email = $nuevoemail;
            $this->telefono = $nuevotelefono;
        }
    }

?>