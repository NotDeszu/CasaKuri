<?php
session_start();
include("../BD/conexion.php");

$producto = $conn->real_escape_string($_POST['producto']);
$inventario = $conn->real_escape_string($_POST['existencia']);
$sucursal = $conn->real_escape_string($_POST['sucursal']);


$sql = "INSERT INTO inventario (inv_existencia, suc_id, pro_id) VALUES ('$inventario','$sucursal','$producto')";


if ($conn->query($sql)) {
    $id = $conn->insert_id;
    $_SESSION['color']="success";
    $_SESSION['msg']="Registro guardado";



} else {
    $_SESSION['color']="danger";
    $_SESSION['msg']="<br>Error al guardar inventario";

}

header('Location: ../indexinv.php');
?>