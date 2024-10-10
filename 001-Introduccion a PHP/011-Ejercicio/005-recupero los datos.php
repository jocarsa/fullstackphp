<?php
    class Cliente{
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public $direccion;
    }
    if(isset($_POST)){
        var_dump($_POST);
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