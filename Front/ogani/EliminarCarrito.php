<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Eliminar el producto del carrito
    $delete_sql = "DELETE carr_inv 
                   FROM carr_inv 
                   INNER JOIN carrito ON carrito.car_id = carr_inv.car_id 
                   WHERE carrito.usu_id = $usuario_id AND carr_inv.inv_id = (SELECT inv_id FROM inventario WHERE pro_id = $delete_id)";

    if ($conn->query($delete_sql) === TRUE) {
        // Verificar si el carrito está vacío
        $check_cart_sql = "SELECT COUNT(*) AS product_count FROM carr_inv 
                           INNER JOIN carrito ON carrito.car_id = carr_inv.car_id 
                           WHERE carrito.usu_id = $usuario_id";

        $result = $conn->query($check_cart_sql);
        $row = $result->fetch_assoc();

        if ($row['product_count'] == 0) {
            // Si el carrito está vacío, eliminar el carrito también
            $delete_cart_sql = "DELETE FROM carrito WHERE usu_id = $usuario_id";
            $conn->query($delete_cart_sql);
        }

        // Redirigir después de eliminar
         // Cambia esto a la ruta de tu carrito
         header("Location: shoping-cart.php"); // Asegúrate de que esto apunte a la página de carrito
         exit();
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}
?>
