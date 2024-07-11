<?php
require ("../BD/conexion.php");

$id = $conn->real_escape_string($_POST['id']);


$sql = "SELECT  pro_id, pro_producto, pro_precio, pro_decripcion, cat_id FROM productos  WHERE pro_id = $id LIMIT 1";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows;

$producto = [];

if($rows > 0){
    $producto = $resultado->fetch_array();
}


echo json_encode($producto, JSON_UNESCAPED_UNICODE);
?>
