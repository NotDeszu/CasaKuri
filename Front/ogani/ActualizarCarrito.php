<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";

// Verificar si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_ids = $_POST['pro_id'];
    $inventario_ids = $_POST['inv_id']; // Suponiendo que estás enviando también los IDs del inventario
    $quantities = $_POST['quantity'];

    $total_subtotal_cart = 0; // Inicializa el subtotal total

    foreach ($product_ids as $index => $product_id) {
        $inventario_id = $inventario_ids[$index]; // Obtener el ID del inventario correspondiente
        $new_quantity = $quantities[$index];

        // Si la cantidad es 0, eliminar el producto de carr_inv
        if ($new_quantity == 0) {
            $delete_sql = "DELETE FROM carr_inv 
                           WHERE inv_id = $inventario_id";
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
                           SET carinv_cantidad = $new_quantity, carinv_subtotal = $new_subtotal
                           WHERE inv_id = $inventario_id";
            if (!$conn->query($update_sql)) {
                die("Error al actualizar el carrito_inventario: " . $conn->error);
            }
        }
    }

    // Calcular el total del carrito como la suma de todos los subtotales en carr_inv
    $total_cart_result = $conn->query("SELECT SUM(carinv_subtotal) AS total_cart 
                                        FROM carr_inv
                                        INNER JOIN carrito ON carrito.car_id = carr_inv.car_id
                                        WHERE carrito.usu_id = $usuario_id");

    if (!$total_cart_result) {
        die("Error al calcular el total del carrito: " . $conn->error);
    }

    $total_cart_row = $total_cart_result->fetch_assoc();
    $car_total = $total_cart_row['total_cart'] ?? 0; // Si es NULL, asigna 0

    // Actualizar el subtotal del carrito
    if ($total_subtotal_cart == 0) {
        $delete_carrito_sql = "DELETE FROM carrito WHERE usu_id = $usuario_id";
        if (!$conn->query($delete_carrito_sql)) {
            die("Error al eliminar el carrito: " . $conn->error);
        }
    } else {
        // Actualizar el subtotal y total del carrito
        $carrito_update_sql = "UPDATE carrito 
                               SET car_subtotal = $total_subtotal_cart, car_total = $car_total
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