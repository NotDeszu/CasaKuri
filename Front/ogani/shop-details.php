<?php
session_start();
$is_logged_in = isset($_SESSION['usu_id']);

include("../../BD/conexion.php");
include "../../funciones/usuario.php";

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM productos WHERE pro_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: shop-grid.php");
    exit;
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
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
                <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>1</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
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
                <li><i class="fa fa-envelope"></i>
                    <?php
                    if (empty($_SESSION["usu_id"])) {
                        echo " ";
                    } else {
                        echo $_SESSION["usu_email"];
                    }
                    ?>
                </li>
                <li>Envios a toda la Republica Mexicana</li>
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
                        <h2>Pagina de Producto</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <a href="./shop-grid.php">shop</a>
                            <span><?php echo htmlspecialchars($product['pro_Producto']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?php echo htmlspecialchars($product['pro_imagen']); ?>" alt="">
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo htmlspecialchars($product['pro_Producto']); ?></h3>

                        <div class="product__details__price">$<?php echo number_format($product['pro_precio'], 2); ?></div>

                        <p><?php echo htmlspecialchars($product['pro_decripcion']); ?></p>

                        <!-- Formulario de Carrito -->
                        <div>
                            <form action="carritoGuarda.php" method="GET">
                                <h3>Selecciona la sucursal: </h3>
                                <select id="inventa" name="inventa" onchange="cantidadMax()">
                                    <?php
                                    // Consulta para obtener las existencias y sucursales
                                    $sucsql = "SELECT * FROM inventario i, sucursal s WHERE pro_id = " . $product_id . " AND i.suc_id = s.suc_id";
                                    $sucres = mysqli_query($conn, $sucsql); // Ejecuta la consulta
                                    if (!$sucres) {
                                        die("Error en la consulta: " . mysqli_error($conn)); // Manejo de errores
                                    }

                                    if (mysqli_num_rows($sucres) > 0) {
                                        while ($existe = mysqli_fetch_array($sucres)) { ?>
                                            <option value="<?php echo $existe["inv_id"]; ?>" data-existencia="<?php echo $existe["inv_existencia"]; ?>">
                                                <?php echo "( " . $existe["inv_existencia"] . " ) " . $existe["suc_nombre"]; ?>
                                            </option>
                                        <?php }
                                    } else { ?>
                                        <option value="">Sin existencia</option>
                                    <?php } ?>
                                </select>

                                <br>
                                <br>
                                <p id="_in_clave"></p>
                                <script>
                                    function cantidadMax() {
                                        var select = document.getElementById("inventa");
                                        var selectedOption = select.options[select.selectedIndex];
                                        var existencias = selectedOption.getAttribute("data-existencia"); // Obtiene la cantidad de existencias

                                        // Actualiza el párrafo con la cantidad de existencias
                                        document.getElementById("_in_clave").innerHTML = "Cantidad en existencia: " + existencias;

                                        // Establece el valor máximo del input de cantidad
                                        var cantidadInput = document.getElementById("cant");
                                        cantidadInput.setAttribute("max", existencias); // Establece el máximo
                                        cantidadInput.value = 0; // Resetea el valor a 0 cuando se cambia la sucursal
                                    }
                                </script>

                                <h3>Cantidad</h3>
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="">
                                            <input type="number" id="cant" name="cant" min="0" value="0">
                                            <style>
                                                input[type="number"] {
                                                    background-color: transparent;
                                                    width: 100px;
                                                    border: 1px solid #ccc;
                                                    color: #000;
                                                    padding: 5px;
                                                    font-size: 16px;
                                                    outline: none;
                                                    border:line;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <input type="hidden" id="cliente" name="cliente" value="<?php echo $is_logged_in ? $_SESSION['usu_id'] : ''; ?>">
                                <input type="hidden" id="accion" name="accion" value="insCarrito">

                                <br>
                                <button class="primary-btn" type="submit" <?php if (!$is_logged_in) echo 'disabled'; ?>> Agregar al Carrito</button>
                                <?php if (!$is_logged_in) { ?>
                                    <p>Por favor, <a href="login3.php">inicie sesión o cree una cuenta</a> para agregar productos al carrito.</p>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

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
