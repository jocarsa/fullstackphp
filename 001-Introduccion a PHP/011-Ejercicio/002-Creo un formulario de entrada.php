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
<form method="POST" action="?">
    <input type="text" name="nombre" placeholder="nombre">
    <input type="text" name="apellidos" placeholder="apellidos">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="telefono" placeholder="telefono">
    <input type="submit">
</form>