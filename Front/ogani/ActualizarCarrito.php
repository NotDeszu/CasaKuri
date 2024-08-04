<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";

// Verificar si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_ids = $_POST['pro_id'];
    $quantities = $_POST['quantity'];

    $total_subtotal_cart = 0; // Inicializa el subtotal total

    foreach ($product_ids as $index => $product_id) {
        $new_quantity = $quantities[$index];

        // Si la cantidad es 0, eliminar el producto de carr_inv
        if ($new_quantity == 0) {
            $delete_sql = "DELETE carr_inv 
                           FROM carr_inv 
                           INNER JOIN inventario ON inventario.inv_id = carr_inv.inv_id
                           INNER JOIN carrito ON carrito.car_id = carr_inv.car_id 
                           WHERE carrito.usu_id = $usuario_id AND inventario.pro_id = $product_id";
            if (!$conn->query($delete_sql)) {
                die("Error al eliminar el producto: " . $conn->error);
            }
        } else {
            // Obtener el precio del producto
            $price_result = $conn->query("SELECT pro_precio, pro_precioIVA FROM productos WHERE pro_id = $product_id");
            if (!$price_result) {
                die("Error al obtener el precio del producto: " . $conn->error);
            }
            $price_row = $price_result->fetch_assoc();
            $precio = $price_row['pro_precio'];
            $precioIVA = $price_row['pro_precioIVA'];

            // Calcular el nuevo subtotal para la tabla carr_inv usando pro_precioIVA
            $new_subtotal = $new_quantity * $precioIVA; // Usa el precio con IVA
            $total_subtotal_cart += $new_quantity * $precio; // Acumula el subtotal usando pro_precio

            // Actualizar la cantidad y subtotal en la tabla carr_inv
            $update_sql = "UPDATE carr_inv 
                           INNER JOIN inventario ON inventario.inv_id = carr_inv.inv_id
                           INNER JOIN carrito ON carrito.car_id = carr_inv.car_id
                           SET carinv_cantidad = $new_quantity, carinv_subtotal = $new_subtotal
                           WHERE inventario.pro_id = $product_id AND carrito.usu_id = $usuario_id";
            if (!$conn->query($update_sql)) {
                die("Error al actualizar el carrito_inventario: " . $conn->error);
            }
        }
    }

    // Actualizar el subtotal del carrito con el total de los productos (sin IVA)
    if ($total_subtotal_cart == 0) {
        $delete_carrito_sql = "DELETE FROM carrito WHERE usu_id = $usuario_id";
        if (!$conn->query($delete_carrito_sql)) {
            die("Error al eliminar el carrito: " . $conn->error);
        }
    } else {
        // Actualizar el subtotal del carrito
        $carrito_update_sql = "UPDATE carrito 
                               SET car_subtotal = $total_subtotal_cart, car_iva = ($total_subtotal_cart*0.16)
                               WHERE usu_id = $usuario_id";
        if (!$conn->query($carrito_update_sql)) {
            die("Error en la actualización del carrito: " . $conn->error);
        }
    }

    // Redirigir al carrito después de la actualización
    header("Location: shoping-cart.php");
    exit();
}
?>
