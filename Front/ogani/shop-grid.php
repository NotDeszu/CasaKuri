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

    <!-- Hero Section Begin -->
    <!-- <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Sucursales</span>
                        </div>
                        <ul>
                            <li><a href="#">Queretaro</a></li>
                            <li><a href="#">Guadalajara</a></li>
                            <li><a href="#">Monterrey</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>442 448 9927</h5>
                                <span>Contactanos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/lapicescasakuri.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Casa Kuri</h2>
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
                                            <span>MAR 05, 2019</span>
                                        </div>
                                    </a>
                                    <a class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="img/blog/sidebar/gdlj2.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>Sucursal<br /> Guadalajara</h6>
                                            <span>MAR 05, 2019</span>
                                        </div>
                                    </a>
                                    <a class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="img/blog/sidebar/mtry2.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>Sucursal<br />Monterrey</h6>
                                            <span>MAR 05, 2019</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ctf -->
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Ultimos productos agregados</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/gomapelikan.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Goma</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/libretarayapelikan.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Libreta</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/marcatextosamarillo.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Marcador</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/mochila1.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mochila</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pegamento850.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Resistol</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/tijerasbarrilito.png">
                                            <div class="product__discount__percent">new</div>
                                            <ul class="product__item__pic__hover">

                                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Tijeras</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <img src="<?php echo htmlspecialchars($product['pro_imagen']); ?>" alt="<?php echo htmlspecialchars($product['pro_Producto']); ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="shop-details.php?id=<?php echo $product['pro_id']; ?>"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#" class="add-to-cart" data-pro-id="<?php echo $product['pro_id']; ?>">
                                                        <i class="fa fa-shopping-cart"></i>
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
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.php"><img src="img/logo rm ck.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
        </div>
    </footer>
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