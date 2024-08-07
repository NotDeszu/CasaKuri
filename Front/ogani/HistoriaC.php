<?php
include("../../BD/conexion.php");
session_start();
include "../../funciones/usuario.php";
$sqlCompras = " SELECT  ven_id,ven_id_transaccion, ven_fecha,status,ven_total from venta where usu_id = $usuario_id order by date(ven_fecha) DESC";
$venta = $conn->query($sqlCompras);
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
    <main>
        <br>
        <br>

        <div class="container">
            <h4>Mis compras</h4>
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