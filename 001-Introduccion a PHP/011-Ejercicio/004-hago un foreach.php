<?php
    class Cliente{
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public $direccion;
        public function __construct(
            $nuevonombre,
            $nuevaedad,
            $nuevoemail,
            $nuevotelefono,
            $nuevadireccion
        ){
            $this->nombre = $nuevonombre;
            $this->edad = $nuevaedad;
            $this->email = $nuevoemail;
            $this->telefono = $nuevotelefono;
            $this->direccion = $nuevadireccion;
        }
    }

?>
<form method="POST" action="?">
    <?php   
        $cliente = new Cliente("","","","","");
        $propiedades = get_class_vars(get_class($cliente));
        foreach($propiedades as $clave=>$valor){
            echo '
                <input type="text" name="'.$clave.'" placeholder="'.$clave.'">
            ';
        }
    ?>
    <input type="submit">
</form>