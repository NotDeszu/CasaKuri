<?php
require('../BD/conexion.php');
include("../funciones/usuario.php");

$sqlUltimaventa = "	SELECT venta.ven_id, ven_total, ven_subtotal
                        FROM venta
                        WHERE venta.usu_id = $usuario_id  
                        ORDER BY venta.ven_fecha DESC
                        LIMIT 1"; // Obtiene solo la última venta

$res_ultimavena = $conn->query($sqlUltimaventa);
$ultima_venta = $res_ultimavena->fetch_assoc();
$ultima_venta_id = $ultima_venta['ven_id'];
$total = $ultima_venta['ven_total'];
$subtotal = $ultima_venta['ven_subtotal'];

echo ($ultima_venta_id);

$sqlProductos ="SELECT  deve_cantidad, productos.pro_producto, pro_precioIVA * deve_cantidad as producto from detalle_venta 
						INNER JOIN venta ON venta.ven_id = detalle_venta.ven_id
                        INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                        INNER JOIN productos ON inventario.pro_id = productos.pro_id
                        where detalle_venta.ven_id = $ultima_venta_id";
$res_productos = $conn->query($sqlProductos);



?>

<tbody>
                            <?php while ($row_productos = $res_productos->fetch_assoc()) { ?>
                                <tr class="text-center">
                                    <td><?= htmlspecialchars($row_productos['pro_producto']); ?></td>
                                    <td><?= htmlspecialchars($row_productos['producto']); ?></td>
                                    <td>$<?= htmlspecialchars($row_productos['deve_cantidad']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>