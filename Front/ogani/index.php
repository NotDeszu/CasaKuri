<?php
session_start();
include "../../funciones/usuario.php";
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
    <link rel="stylesheet" href="css/cosas.css" type="text/css">
    <link rel="stylesheet" href="css/cubo.css" type="text/css">
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
            <!-- <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
            <div class="header__top__right__auth">
                <a href="controlador_cerrars2.php"><i class="fa fa-user"></i> 
                <?php
                    if(empty($_SESSION["usu_id"])){
                        echo "Iniciar Sesion";
                    }else{
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
                    if(empty($_SESSION["usu_id"])){
                        echo " ";
                    }else{
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
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categorias</span>
                        </div>
                        <ul>
                        <li><a>Plumas</a></li>
                        <li><a >Cuadernos</a></li>
                        <li><a >Calculadoras</a></li>
                        <li><a >Sacapuntas</a></li>
                        <li><a >Marcadores</a></li>
                        <li><a >Carpetas</a></li>
                        <li><a >Resistol</a></li>
                        <li><a >Gomas de Borrar</a></li>
                        <li><a >Reglas</a></li>
                        <li><a >Tijeras</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <a class="btn-shine">Casa kuri Donde cada idea encuentra su herramienta perfecta</a>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <button class="btn">Casa kuri</button>
                        </div>
                    </div>
                    <!--EMPIEZA seccion de banner?-->
                    <div class="hero__item set-bg" data-setbg="img/hero/BannerCKr.png">
                        <div class="hero__text">
                            <span>Papeleria</span>
                            <h2>Casa<br /> kuri</h2>
                            <p>Los mejores productos de papeleria</p>
                            <a href="shop-grid.php" class="primary-btn">Comprar ahora</a>
                        </div>
                    </div>
                    <!--quiero poner otra cosa aqui-->
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/libreta.png">
                            <h5><a >Libretas</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/pegamentoprint.png">
                            <h5><a >Pegamento Lapiz</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/plumonrojob.png">
                            <h5><a >Plumones</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/tijeraspelikan.png">
                            <h5><a >Tijeras</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/test.png">
                            <h5><a >Resistoles</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">

        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/Banner1.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/Banner2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- cubo 3d -->
    <!-- <section class="prueba">
        <div class="containercubo">
        <div class="cube">
            <div style="--x:-1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:0; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
        </div>
        <div class="cube">
            <div style="--x:-1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:0; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
        </div>
        <div class="cube">
            <div style="--x:-1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:0; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
            <div style="--x:1; --y:0;">
            <span style="--i:3;"></span>
            <span style="--i:2;"></span>
            <span style="--i:1;"></span>
            </div>
        </div>
        </div>
    </section> -->

    <!-- end cubo -->
    <section class="hero">
        <div class="container">

        </div>
    </section>
    <!-- Footer Section Begin -->
    <section class="hero">
        <div class="container">
        <?php
        include "../../menus/footer.html";
        ?>
        </div>
    </section>
    
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