<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";

if (empty($_SESSION["usu_id"])){
    header("Location: index.php");
    exit;
}

$VentaClave = $_GET["vent_id"];

$sqlCompras = " SELECT  ven_id,ven_id_transaccion, ven_fecha,status,ven_total from venta where ven_id=$VentaClave";
$venta = $conn->query($sqlCompras);
$ventaData = $venta->fetch_assoc(); // Guardamos el resultado en una variable
$fecha = $ventaData['ven_fecha'];
$orden = $ventaData['ven_id_transaccion'];
$status = $ventaData['status'];
$total = $ventaData['ven_total'];


$sqlProductosVenta = "SELECT  deve_cantidad,pro_precioIVA, productos.pro_producto, pro_precioIVA * deve_cantidad as PrecioProducto from detalle_venta 
INNER JOIN venta ON venta.ven_id = detalle_venta.ven_id
INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
INNER JOIN productos ON inventario.pro_id = productos.pro_id
where detalle_venta.ven_id = $VentaClave";
$productos = $conn->query($sqlProductosVenta);




?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ogani Template">
        <meta name="keywords" content="Ogani, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mis ventas</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle de venta</title>
    </head>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    <li class="nav-item">
                        <a class="nav-link" href="HistoriaC.php">Ventas</a>
                    </li>
                    <li class="row justify-content-end align-items-center">
                        <p class="text-white">
                            <?php
                            if (empty($_SESSION["usu_id"])) {
                                echo " ";
                            } else {
                                echo $_SESSION["usu_email"];
                            }
                            ?>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Detalle de la compra</strong>
                    </div>
                    <div class="card-body">
                        <strong>Fecha:<?php echo $fecha ?></strong>
                        <br>
                        <strong>Folio:<?php echo $orden ?></strong>
                        <br>
                        <strong>Status:<?php echo $status ?></strong>
                        <br>
                        <br>
                        <strong>Total:<?php echo ' $' . $total ?></strong>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php
                                while ($row_productos = $productos->fetch_assoc()) { ?>
                                    <td><?= htmlspecialchars($row_productos['pro_producto']); ?></td>
                                    <td><?= htmlspecialchars($row_productos['pro_precioIVA']); ?></td>
                                    <td><?= htmlspecialchars($row_productos['deve_cantidad']); ?></td>
                                    <td><?= htmlspecialchars($row_productos['PrecioProducto']); ?></td>
                            </tr>



                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
    include "../../menus/footer.html";
    ?>
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