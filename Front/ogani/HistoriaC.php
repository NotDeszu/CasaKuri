<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";
$sqlCompras = " SELECT  ven_id,ven_id_transaccion, ven_fecha,status,ven_total from venta where usu_id = $usuario_id order by date(ven_fecha) DESC";
$venta = $conn->query($sqlCompras);

if (empty($_SESSION["usu_id"])){
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <title>Mis compras</title>
</head>

<body>
    <!-- prueba de header -->
<?php
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
                            <?php
                            if (isset($_SESSION["rol_id"])) {
                                echo '<a href="HistoriaC.php">Ver Mis compras</a>';
                            }
                            ?>
                            <!-- fin -->
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
                        <li><a href="./shop-grid.php">Productos</a></li>
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
    <!-- fin prueba header -->
    <main>
        <br>
        <br>

        <div class="container">
            <h1>Mis compras</h1>
            <hr>
            <?php
            while ($row_ventas = $venta->fetch_assoc()) { ?>
                <form action="compra_detalle.php" method="GET">
                    <div class="card mb-3">
                        <div class="card-header">
                            Fecha: <?= htmlspecialchars($row_ventas['ven_fecha']); ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Folio:<?= htmlspecialchars($row_ventas['ven_id_transaccion']); ?></h5>
                            <p class="card-text">Total: <?= htmlspecialchars($row_ventas['ven_total']); ?></p>
                            <input type="hidden" id="vent_id" name="vent_id" value="<?= htmlspecialchars($row_ventas['ven_id']); ?>">
                            <button class="btn btn-primary">Ver compra </button>
                        </div>
                </form>
        </div>
    <?php } ?>
    </div>
    </main>
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