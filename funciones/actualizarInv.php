<?php
session_start();
require "../BD/conexion.php";
$id = $conn->real_escape_string($_POST['id']);
$producto = $conn->real_escape_string($_POST['producto']);
$inventario = $conn->real_escape_string($_POST['existencia']);
$sucursal = $conn->real_escape_string($_POST['sucursal']);

$sql = "UPDATE inventario  SET inv_existencia = '$inventario', suc_id = '$sucursal', pro_id = '$producto'  WHERE inv_id='$id'";


if ($conn->query($sql)) {
    $_SESSION['color']="success";
    $_SESSION['msg'] = "Registro Actualizado";

} else {
    $_SESSION['color']="Danger";

    $_SESSION['msg'] = "<br>Error al actualizar Inventario";
}


header('Location: ../indexInv.php');
