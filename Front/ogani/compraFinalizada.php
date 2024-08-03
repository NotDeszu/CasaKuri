<?php
session_start();
include("../../BD/conexion.php");
include "../../funciones/usuario.php";

// Obtener la última venta del usuario
$sql_detalles_venta = "SELECT venta.ven_id,ven_total, detalle_venta.inv_id, deve_cantidad, pro_Producto
                        FROM venta
                        INNER JOIN detalle_venta ON venta.ven_id = detalle_venta.ven_id
                        INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                        INNER JOIN productos ON inventario.pro_id = productos.pro_id
                        WHERE venta.usu_id = $usuario_id
                        ORDER BY venta.ven_fecha DESC
                        LIMIT 1"; // Obtiene solo la última venta

$result_detalles_venta = $conn->query($sql_detalles_venta);
$ultima_venta = $result_detalles_venta->fetch_assoc();
$ultima_venta_id = $ultima_venta['ven_id'];
$total = $ultima_venta['ven_total'];

echo ("ultima venta = $ultima_venta_id");
echo ("ultima venta = $total");

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://www.paypal.com/sdk/js?client-id=AXd1CrQrWcdIbGX1wsvNP6DH-j40e3rkdebVDwCiqbMk0B_bEX6XaFjETom8mt6BD1EBArMIJEl2H_5Y&currency=MXN"></script>
</head>

<body>
    <?php
    include "../../menus/menuFront.php";
    ?>

    <div class="container mt-5">
        <!-- Mensaje de agradecimiento -->
        <div class="text-center mb-4">
            <h1>¡Muchas gracias por tu compra!</h1>
        </div>

        <!-- Tabla de la venta realizada -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica si hay resultados
                    if ($result_detalles_venta->num_rows > 0) {
                        while ($row_venta = $result_detalles_venta->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row_venta['pro_Producto']); ?></td>
                                <td><?= htmlspecialchars($row_venta['deve_cantidad']); ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No se encontraron ventas.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>$<?= $total ?></strong></td>
                    </tr>
                </tfoot>
            </table>

        </div>

        <!-- Botones para imprimir -->
        <div class="d-flex justify-content-center mt-4">
            <a href="../../reportes/factura.php?ven_id=<?= $ultima_venta_id ?>" class="btn btn-primary me-3">Imprime tu factura</a>
            <a href="imprimir_recibo.php" class="btn btn-warning">Imprime tu recibo</a>
        </div>


    </div>

    <?php
    include "../../menus/footer.html";
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>




</html>