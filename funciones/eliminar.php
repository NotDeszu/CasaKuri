<?php
session_start();
require "../BD/conexion.php";

$id = $conn->real_escape_string($_POST['id']);

// Start transaction
$conn->begin_transaction();

try {
    // Update productos table
    $sql_productos = "UPDATE productos SET pro_status = 0 WHERE pro_id = ?";
    $stmt_productos = $conn->prepare($sql_productos);
    $stmt_productos->bind_param("i", $id);
    $stmt_productos->execute();

    // Update inventario table
    $sql_inventario = "UPDATE inventario SET inv_existencia = 0 WHERE pro_id = ?";
    $stmt_inventario = $conn->prepare($sql_inventario);
    $stmt_inventario->bind_param("i", $id);
    $stmt_inventario->execute();

    // If we get here, both queries were successful
    $conn->commit();

    $dir = "imagenes";
    $imagen = $dir . '/' . $id . '.jpg';

    if (file_exists($imagen)) {
        unlink($imagen);
    }

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro eliminado";
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al eliminar Registro: " . $e->getMessage();
}

header('Location: ../indexAdmin.php');
exit();
?>