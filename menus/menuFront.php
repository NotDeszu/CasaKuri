<?php
require_once '../../BD/conexion.php';


$sqlCantTotCarr = "select carinv_cantidad, carinv_subtotal from carr_inv inner join carrito on carrito.car_id = carr_inv.car_id where usu_id =$usuario_id";
$cantidadCarrito = $conn->query($sqlCantTotCarr);
?>
<header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>
                                    <?php
                                    if (empty($_SESSION["usu_id"])) {
                                        echo " ";
                                    } else {
                                        echo $_SESSION["usu_email"];
                                    }
                                    ?>
                                </li>
                                <li>Envios a toda la republica Mexicana</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">

<!-- Esta parte muestra un link hacia el panel administrador, si es que el usuario logeado tiene el rol de admin -->
                                <?php
                                if (isset($_SESSION["rol_id"])) {
                                    if ($_SESSION["rol_id"] == 0) {
                                        echo " ";
                                    } elseif ($_SESSION["rol_id"] == 1) { ?>
                                        <a href="../../indexAdmin.php">Pagina de Administrador</a>
                                    <?php
                                    } else {
                                        echo " ";
                                    }                        
                                } else {
                                    echo " ";
                                }
                                ?>
                        <!-- fin -->
                                <a href="https://www.facebook.com/casakuri"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/casa.kuri/"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="controlador_cerrars2.php"><i class="fa fa-user"></i>
                                    <?php
                                    if (empty($_SESSION["usu_id"])) {
                                        echo "Iniciar Sesion";
                                    } else {
                                        echo "Cerrar Sesion";
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aqui termina el header top -->
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo rm ck.png" alt="" width="200"></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Inicio</a></li>
                            <li class="active"><a href="./shop-grid.php">Productos</a></li>
                            <li><a href="#">Paginas</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.php">Productos</a></li>
                                    <li><a href="./shoping-cart.php">Carrito</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./contact.php">Contactanos</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <?php
                        // Inicializa las variables para cantidad total y subtotal
                        $totalCantidad = 0;
                        $subtotal = 0;

                        // Itera a través de los resultados de la consulta
                        while ($row_carritoInfo = $cantidadCarrito->fetch_assoc()) {
                            // Suma la cantidad de cada producto al total
                            $totalCantidad += $row_carritoInfo['carinv_cantidad'];
                            // Suma el subtotal de cada producto al total del carrito
                            $subtotal += $row_carritoInfo['carinv_subtotal'];
                        }
                        ?>
                        <ul>
                            <li><a href="shoping-cart.php"><i class="fa fa-shopping-cart"></i><span><?= $totalCantidad ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span>$<?= number_format($subtotal, 2) ?></span></div>
                    </div>
                </div>

            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>