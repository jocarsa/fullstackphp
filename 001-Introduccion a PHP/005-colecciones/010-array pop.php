<?php

    // Pila - LIFO - Last in, first out
    // Cola - FIFO - First in, first out

    $agenda = [];
    array_push($agenda,"Jose Vicente");
    array_push($agenda,"Juan");
    array_push($agenda,"Jorge");
    
    var_dump($agenda);
    echo "<br>";
    array_pop($agenda);

    var_dump($agenda);

?>