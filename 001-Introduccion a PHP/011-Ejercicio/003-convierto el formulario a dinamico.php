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
    <?php   
        $cliente = new Cliente("","","","");
        $propiedades = get_class_vars(get_class($cliente));
        var_dump($propiedades);
    ?>
    <input type="text" name="nombre" placeholder="nombre">
    <input type="text" name="apellidos" placeholder="apellidos">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="telefono" placeholder="telefono">
    <input type="submit">
</form>