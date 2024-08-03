<?php
if (!empty($_SESSION["usu_id"])) {
    // Guarda el ID del usuario en una variable
    $usuario_id = $_SESSION["usu_id"];

    //Imprimo el id 
    //echo "El ID del usuario es: " . $usuario_id . "<br>";
} else {
    //Si no se guarda 
    $usuario_id = 0;
}

?>