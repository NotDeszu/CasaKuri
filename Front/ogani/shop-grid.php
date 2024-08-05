<?php
session_start();
include "../../funciones/usuario.php";
require_once '../../BD/conexion.php';

require './carrito/prueba add pr/functions.php';

$sucursal_id = isset($_GET['sucursal']) ? intval($_GET['sucursal']) : 0;
$categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;

$products = getFilteredProducts($sucursal_id, $categoria_id);

// Debug: Print the number of products found 
echo "<!-- Debug: Number of products found: " . count($products) . " -->";



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
                        <h2>Casa Kuri</h2>
                        <h2>Productos</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categorias</h4>
                            <ul>
                                <li><a>Plumas</a></li>
                                <li><a>Cuadernos</a></li>
                                <li><a>Calculadoras</a></li>
                                <li><a>Sacapuntas</a></li>
                                <li><a>Marcadores</a></li>
                                <li><a>Carpetas</a></li>
                                <li><a>Resistol</a></li>
                                <li><a>Gomas de Borrar</a></li>
                                <li><a>Reglas</a></li>
                                <li><a>Tijeras</a></li>
                            </ul>
                        </div>
                        <!-- ctf -->
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sucursales <br />Casa Kuri</h4>
                                <div class="blog__sidebar__recent">
                                    <a class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="img/blog/sidebar/qro2.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>Sucursal<br /> Queretaro</h6>
                                            <span>Julio 27, 2019</span>
                                        </div>
                                    </a>
                                    <a class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="img/blog/sidebar/gdlj2.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>Sucursal<br /> Guadalajara</h6>
                                            <span>MAR 07, 2021</span>
                                        </div>
                                    </a>
                                    <a class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="img/blog/sidebar/mtry2.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>Sucursal<br />Monterrey</h6>
                                            <span>Nov 23, 2023</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ctf -->
                <div class="col-lg-9 col-md-7">
                    <div class="section-title product__discount__title">
                        <h2>Productos Papeleria Kuri</h2>
                    </div>
                    <!-- empieza filtros de busqueda -->
                    <form method="GET" action="">
                        <div class="filter__item">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter__sort">
                                        <span>Sucursal:</span>
                                        <select name="sucursal">
                                            <option value="0">Todos</option>
                                            <?php
                                            $sucursales = getSucursales();
                                            foreach ($sucursales as $sucursal) {
                                                $selected = ($_GET['sucursal'] == $sucursal['suc_id']) ? 'selected' : '';
                                                echo "<option value='" . $sucursal['suc_id'] . "' $selected>" . $sucursal['suc_nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter__sort">
                                        <span>Categoria:</span>
                                        <select name="categoria">
                                            <option value="0">Todos</option>
                                            <?php
                                            $categorias = getCategorias();
                                            foreach ($categorias as $categoria) {
                                                $selected = ($_GET['categoria'] == $categoria['cat_id']) ? 'selected' : '';
                                                echo "<option value='" . $categoria['cat_id'] . "' $selected>" . $categoria['cat_nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="filter__found">
                                        <button type="submit" class="site-btn">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Aqui es la parte dinamica que agrega productos  -->
                    <div class="row">
                        <?php if (empty($products)) : ?>
                            <p>No se encontraron productos que coincidan con los filtros seleccionados.</p>
                        <?php else : ?>
                            <?php foreach ($products as $product) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img class="" src="<?php echo htmlspecialchars($product['pro_imagen']); ?>" alt="<?php echo htmlspecialchars($product['pro_Producto']); ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="shop-details.php?id=<?php echo $product['pro_id']; ?>"><i class="fa fa-eye"></i></a></li>
                                                    </a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#"><?php echo htmlspecialchars($product['pro_Producto']); ?></a></h6>
                                            <h5>$<?php echo number_format($product['pro_precio'], 2); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- termina parte dinamica de visualizacion de productos -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sucursalSelect = document.querySelector('select[name="sucursal"]');
            const categoriaSelect = document.querySelector('select[name="categoria"]');
            const productCountSpan = document.getElementById('product-count');

            function updateProducts() {
                const sucursal = sucursalSelect.value;
                const categoria = categoriaSelect.value;

                fetch(`your_php_script.php?sucursal=${sucursal}&categoria=${categoria}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.row').innerHTML = html;
                        productCountSpan.textContent = document.querySelectorAll('.product__item').length;
                    });
            }

            sucursalSelect.addEventListener('change', updateProducts);
            categoriaSelect.addEventListener('change', updateProducts);
        });
    </script>

</body>

</html>