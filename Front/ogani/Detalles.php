<?php
// Verifica si hay un mensaje en la URL
$datosRecibidos = isset($_GET['message']) && $_GET['message'] === 'datos_recibidos';
if ($datosRecibidos) {
}

session_start();
include("../../BD/conexion.php");
include "../../funciones/usuario.php";


$sqlUsuarioCarrito = "SELECT Productos.pro_id, pro_Producto, pro_precio, pro_imagen, carinv_cantidad, carinv_subtotal 
                      FROM carr_inv 
                      INNER JOIN carrito ON carrito.car_id = carr_inv.car_id
                      INNER JOIN inventario ON inventario.inv_id = carr_inv.inv_id
                      INNER JOIN productos ON productos.pro_id = inventario.pro_id
                      WHERE carrito.usu_id = $usuario_id";
$carrito = $conn->query($sqlUsuarioCarrito);

$sqlDetalles = "SELECT car_total, car_subtotal FROM carrito WHERE usu_id = $usuario_id";
$detalles = $conn->query($sqlDetalles);

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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=AXd1CrQrWcdIbGX1wsvNP6DH-j40e3rkdebVDwCiqbMk0B_bEX6XaFjETom8mt6BD1EBArMIJEl2H_5Y&currency=MXN"></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo rm ck.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./shop-grid.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.php">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <?php
    include "../../menus/menuFront.php";
    ?>
    <!-- Header Section End -->



    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/lapicescasakuri.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Detalles de pago</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Carrito de Compras</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->



    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">

        <div class="row justify-content-center"> <!-- Centrar todo el contenido -->
            <div class="col-8"> <!-- Aumenta el tamaño de la columna -->
                <div class="shoping__cart__table">
                    <table class="table" style="width: 100%; border-collapse: collapse;"> <!-- Sin bordes -->
                        <thead>
                            <tr class="text-center">
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total x Producto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_carrito = $carrito->fetch_assoc()) { ?>
                                <tr class="text-center">
                                    <td><?= htmlspecialchars($row_carrito['pro_Producto']); ?></td>
                                    <td><?= htmlspecialchars($row_carrito['carinv_cantidad']); ?></td>
                                    <td>$<?= htmlspecialchars($row_carrito['carinv_subtotal']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($row_detalles = $detalles->fetch_assoc()) { ?>
                    <div class="d-flex justify-content-center" style="margin-top: 10px;">
                        <strong>Total con IVA: $<?= $total = $row_detalles['car_total']; ?></strong>
                    </div>
                <?php } ?>

                <div class="d-flex justify-content">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalfactura">
                        Requiero Factura
                    </button>
                </div>


                <div class="mt-4">
                    <?php if ($datosRecibidos) { ?>
                        <div class="alert alert-success" role="alert">
                            Datos de la factura recibidos correctamente.
                        </div>
                    <?php } ?>
                    <table class="table mt-3 <?= $datosRecibidos ? '' : 'd-none'; ?>">
                        <thead>
                            <tr>
                                <th>Nombre/Razón Social</th>
                                <th>RFC</th>
                                <th>Domicilio</th>
                                <th>Régimen Fiscal</th>
                                <th>Uso CFDI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'No disponible'; ?></td>
                                <td><?= isset($_SESSION['rfc']) ? htmlspecialchars($_SESSION['rfc']) : 'No disponible'; ?></td>
                                <td><?= isset($_SESSION['domicilio']) ? htmlspecialchars($_SESSION['domicilio']) : 'No disponible'; ?></td>
                                <td><?= isset($_SESSION['regimen']) ? htmlspecialchars($_SESSION['regimen']) : 'No disponible'; ?></td>
                                <td><?= isset($_SESSION['cfdi']) ? htmlspecialchars($_SESSION['cfdi']) : 'No disponible'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                if ($datosRecibidos) {
                    unset($_SESSION['nombre']);
                    unset($_SESSION['rfc']);
                    unset($_SESSION['domicilio']);
                    unset($_SESSION['regimen']);
                    unset($_SESSION['cfdi']);
                }
                ?>
            </div>


            <div class="container">
                <div class="row col justify-content-center">
                    <div class="col-3">
                        <div id="paypal" class="d-flex justify-content-center" style="margin-top: 20px;"></div> <!-- Botones de PayPal centrados -->
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal para solicitar factura -->


        <script>
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    size: 'large',
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?php echo $total ?>
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    let url = '../../funciones/capturaPaypal.php';
                    return actions.order.capture().then(function(detalles) {
                        console.log(detalles);
                        return fetch(url, {
                            method: 'post',
                            headers: {
                                'content-type': 'application/json'
                            },
                            body: JSON.stringify({
                                detalles: detalles
                            })
                        }).then(function(response) {
                            // Redirigir a la página de compra finalizada
                            window.location.href = 'compraFinalizada.php';
                        });
                    });
                },
                onCancel: function(data) {
                    alert("Pago cancelado");
                    console.log(data);
                },
                onError: function(err) {
                    console.error('Error occurred during the transaction', err);
                }
            }).render("#paypal");
        </script>


        <div class="row">
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount"></div>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
    </section>





    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <?php
    include "../../menus/footer.html";
    ?>
    <!-- Footer Section End -->
    <?php
    include('modalfactura.php');
    ?>

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