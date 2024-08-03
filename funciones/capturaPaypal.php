
<?php
require "../BD/conexion.php";
session_start();
include "usuario.php";

// Leer el contenido JSON enviado en la solicitud
$json = file_get_contents('php://input');
$datos = json_decode($json, true);

// Verificar que los datos son válidos
if (is_array($datos)) {
    // Extraer los datos del JSON
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Preparar la consulta para ingresar los datos a la tabla venta
        $sqlventa = "INSERT INTO venta (ven_id_transaccion, ven_fecha, status, ven_email, usu_id, ven_total) 
                     VALUES ('$id_transaccion', '$fecha_nueva', '$status', '$email', $usuario_id, $monto)";

        // Ejecuta la consulta
        if ($conn->query($sqlventa) === TRUE) {
            // Obtiene el ID de la venta
            $ven_id = $conn->insert_id;

            // Obtiene los productos del carrito del usuario
            $sql_carrito = "SELECT * FROM carr_inv 
                            INNER JOIN carrito ON carrito.car_id = carr_inv.car_id 
                            WHERE carrito.usu_id = $usuario_id";
            $resultado_carrito = $conn->query($sql_carrito);

            if ($resultado_carrito->num_rows > 0) {
                while ($row_carrito = $resultado_carrito->fetch_assoc()) {
                    $inv_id = $row_carrito['inv_id'];
                    $cantidad = $row_carrito['carinv_cantidad'];

                    // Inserta cada producto en la tabla detalle_venta
                    $sql_detalle_venta = "INSERT INTO detalle_venta (ven_id, inv_id, deve_cantidad) 
                                          VALUES ($ven_id, $inv_id, $cantidad)";
                    if ($conn->query($sql_detalle_venta) !== TRUE) {
                        throw new Exception("Error al insertar detalle de venta: " . $conn->error);
                    }

                    // Actualiza el inventario
                    $sql_actualizar_inventario = "UPDATE inventario SET inv_existencia = inv_existencia - $cantidad WHERE inv_id = $inv_id";
                    if ($conn->query($sql_actualizar_inventario) !== TRUE) {
                        throw new Exception("Error al actualizar el inventario: " . $conn->error);
                    }
                }
            } else {
                echo "No hay productos en el carrito del usuario.";
            }

            // Elimina productos del carrito inventario
            $sql_eliminar_carrito = "DELETE FROM carr_inv WHERE car_id IN (SELECT car_id FROM carrito WHERE usu_id = $usuario_id)";
            $conn->query($sql_eliminar_carrito);

            // Elimina el carrito
            $sql_eliminar_carrito_general = "DELETE FROM carrito WHERE usu_id = $usuario_id";
            $conn->query($sql_eliminar_carrito_general);

            // Actualizar la factura con el ven_id
            $sql_update_factura = "UPDATE facturas SET ven_id = '$ven_id' WHERE ven_id IS NULL LIMIT 1";
            if ($conn->query($sql_update_factura) === FALSE) {
                throw new Exception("Error actualizando la factura: " . $conn->error);
            }

            // Realiza todas las consultas
            $conn->commit();

        } else {
            throw new Exception("Error al insertar la venta: " . $conn->error);
        }
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $conn->rollback();

        // Eliminar la factura si la venta no se realizó con éxito
        $sql_delete_factura = "DELETE FROM facturas WHERE ven_id IS NULL";
        $conn->query($sql_delete_factura);

        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Datos recibidos no son válidos";
}

$conn->close();
?>
