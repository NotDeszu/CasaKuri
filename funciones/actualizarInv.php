<?php
session_start();
require "../BD/conexion.php";
$id = $conn->real_escape_string($_POST['id']);
$inventario = $conn->real_escape_string($_POST['existencia']);

$sql = "UPDATE inventario  SET inv_existencia = '$inventario' WHERE inv_id='$id'";


if ($conn->query($sql)) {
    $_SESSION['color']="success";
    $_SESSION['msg'] = "Registro Actualizado";

} else {
    $_SESSION['color']="Danger";

    $_SESSION['msg'] = "<br>Error al actualizar Inventario";
}


header('Location: ../indexInv.php');
