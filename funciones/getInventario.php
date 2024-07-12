<?php
require ("../BD/conexion.php");

$id = $conn->real_escape_string($_POST['id']);


$sql = "SELECT productos.pro_id, productos.pro_Producto as producto,inventario.inv_id as inv_id, inventario.inv_existencia as existencia, sucursal.suc_nombre
FROM inventario
JOIN productos ON inventario.pro_id=productos.pro_id
JOIN sucursal ON inventario.suc_id=sucursal.suc_id  WHERE inv_id= $id LIMIT 1";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows;

$producto = [];

if($rows > 0){
    $producto = $resultado->fetch_array();
}


echo json_encode($producto, JSON_UNESCAPED_UNICODE);
?>