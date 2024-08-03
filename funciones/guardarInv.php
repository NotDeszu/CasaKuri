<?php
session_start();
include("../BD/conexion.php");

$id = $conn->real_escape_string($_POST['id']);
$producto = $_POST['producto'];
$sucursal = $_POST['sucursal'];
$existencia = $_POST['existencia'];

// checamos si ya existe un registro del producto en una sucursal
$sqlCheck = "SELECT * FROM inventario WHERE pro_id = ? AND suc_id = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $producto, $sucursal);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Si ya existe un registro que muestre un error
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "El producto ya se encuentra en el inventario de esa sucursal";
    header('Location: ../indexInv.php');
} else {
    // Si no existe un registro, que haga el insert
    $producto = $conn->real_escape_string($_POST['producto']);
    $inventario = $conn->real_escape_string($_POST['existencia']);
    $sucursal = $conn->real_escape_string($_POST['sucursal']);
    $sql = "INSERT INTO inventario (inv_existencia, suc_id, pro_id) VALUES ('$inventario','$sucursal','$producto')";

    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        $_SESSION['color']="success";
        $_SESSION['msg']="Nuevo Registro guardado con exito";
        
    } else {
        $_SESSION['color']="danger";
        $_SESSION['msg']="<br>Error al guardar inventario";
    
    }
}
header('Location: ../indexinv.php');
$conn->close();
?>
