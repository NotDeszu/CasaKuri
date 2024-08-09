<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";

if (empty($_SESSION["usu_id"])){
    header("Location: reg.html");
    exit;
}


$sqlUsuarioCarrito = "SELECT Productos.pro_id, pro_Producto, pro_precio,pro_precioIVA, sucursal.suc_nombre, pro_imagen, inventario.inv_existencia, carinv_cantidad, carinv_subtotal 
                      FROM carr_inv 
                      INNER JOIN carrito ON carrito.car_id = carr_inv.car_id
                      INNER JOIN inventario ON inventario.inv_id = carr_inv.inv_id
                      INNER JOIN productos ON productos.pro_id = inventario.pro_id
                      INNER JOIN sucursal ON sucursal.suc_id = inventario.suc_id
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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

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
                        <h2>Carrito de Compras</h2>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <form method="POST" action="ActualizarCarrito.php">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="">Imagen</th>
                                        <th>Nombre producto</th>
                                        <th>Sucursal</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_carrito = $carrito->fetch_assoc()) { ?>
                                        <tr>
                                            <td><img class="" width="150" height="150" src="<?php echo htmlspecialchars($row_carrito['pro_imagen']); ?>" alt=""></td>
                                            <td><?= htmlspecialchars($row_carrito['pro_Producto']); ?> </td>
                                            <td><?= htmlspecialchars($row_carrito['suc_nombre']); ?></td>
                                            <td><?= htmlspecialchars($row_carrito['inv_existencia']); ?></td>
                                            <td>$<?= htmlspecialchars($row_carrito['pro_precioIVA']); ?></td>
                                            <td>
                                                <div class="">
                                                    <div class="">
                                                        <input type="hidden" id ="idProducto" name="pro_id[]" value="<?= htmlspecialchars($row_carrito['pro_id']); ?>">
                                                        <input class="inputN" id="cantidad" type="number" name="quantity[]" min="0" step="1" value="<?= htmlspecialchars($row_carrito['carinv_cantidad']); ?>" size="5" data-existencia="<?= htmlspecialchars($row_carrito['inv_existencia']); ?>" onchange="validateQuantity(this)">

                                                        <style>
                                                            input[type="number"] {
                                                                background-color: transparent;
                                                                width: 100px;
                                                                border: 1px solid #ccc;
                                                                /* Cambia el color del borde si es necesario */
                                                                color: #000;
                                                                /* Cambia el color del texto si es necesario */
                                                                padding: 5px;
                                                                /* Ajusta el relleno según tus necesidades */
                                                                font-size: 16px;
                                                                /* Ajusta el tamaño de la fuente según tus necesidades */
                                                                outline: none;
                                                                border: line;
                                                                /* Elimina el contorno al hacer clic */
                                                            }
                                                        </style>
                                                    </div>
                                                </div>
                                            </td>
                                            <script>
                                                function validateQuantity(input) {
                                                    var max = input.getAttribute('data-existencia');
                                                    var value = input.value;
                                                    
                                                    if (parseInt(value) > parseInt(max)) {
                                                        alert('La cantidad no puede ser mayor que ' + max + '.');
                                                        input.value = max;
                                                    }
                                                }

                                            </script>
                                            <td>$<?= htmlspecialchars($row_carrito['carinv_subtotal']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="shoping__cart__btns">
                                <a href="shop-details.php" class="primary-btn cart-btn">Seguir comprando</a>
                                <button type="submit" class="primary-btn cart-btn cart-btn-right">Actualizar Carrito <span class="icon_loading"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Detalles</h5>
                        <?php while ($row_detalles = $detalles->fetch_assoc()) { ?>
                            <ul>
                                <li>Subtotal <span>$<?= $row_detalles['car_subtotal']; ?></span></li>
                                <li>Total con IVA <span>$<?= $row_detalles['car_total']; ?></span></li>
                            </ul>
                        <?php } ?>
                        <a href="Detalles.php" class="primary-btn">PROCEDER AL PAGO</a>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <?php
    include "../../menus/footer.html";
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
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