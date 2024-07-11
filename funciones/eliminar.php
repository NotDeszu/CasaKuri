<?php
session_start();
require "../BD/conexion.php";

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM  productos WHERE pro_id='$id'";


if ($conn->query($sql)) {
    $dir ="imagenes";
    $imagen = $dir .'/'.$id.'jpg';

    if (file_exists($imagen)) {
        unlink($imagen);
    }

    $_SESSION['color']="success";
    $_SESSION['msg'] = "Registro eliminado";
   
}else{
    $_SESSION['color']="danger";
    $_SESSION['msg'] = "Error al eliminar Registro";
}

header('Location: ../index.php');
?>