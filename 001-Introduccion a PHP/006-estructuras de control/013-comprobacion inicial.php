<?php
    if(isset($_GET['nombre'])){
        echo "El nombre que has introducido es: ".$_GET['nombre']."<br>";
    }
?>
<form action="?" method="get">
    <input name="nombre">
    <input type="submit">
</form>