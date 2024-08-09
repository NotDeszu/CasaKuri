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


    <!-- Breadcrumb Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="img/blog/details/lapicescasakuri2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>Explora un mundo de creatividad en nuestra tienda donde cada idea encuentra su herramienta perfecta</h2>
                        <ul>
                            <li>por Felipe Cruz</li>
                            <li>Julio 10, 2024</li>
                        </ul>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <h4>Valores</h4>
                            <ul>
                                <li><a>Calidad</a></li>
                                <li><a>Servicio</a></li>
                                <li><a>Innovacion</a></li>
                                <li><a>Integridad</a></li>
                                <li><a>Responsabilidad</a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Mision</h4>
                            <ul>
                                <li><p>Proveer productos de papelería de alta calidad y accesibles.</p></li>
                                <li><p>Ofrecer un servicio al cliente excepcional.</p></li>
                                <li><p>Fomentar relaciones duraderas con proveedores</p></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Vision</h4>
                            <ul>
                                <li><p>Expandir nuestra presencia física y digital.</p></li>
                                <li><p>Liderar en innovación en el sector de papelería.</p></li>
                                <li><p>Ser la tienda de papelería líder y de referencia.</p></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Objetivos</h4>
                            <ul>
                                <li><p>Incrementar ventas un 20% anual.</p></li>
                                <li><p>Añadir 25 nuevos productos al año</p></li>
                                <li><p>Mejorar la capacitación del personal.</p></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Sucursales Casa Kuri</h4>
                            <div class="blog__sidebar__recent">
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/qro2.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Queretaro<br /> </h6>
                                        <span>Julio 27, 2019</span>
                                    </div>
                                </a>
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/mtry2.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Monterrey<br /> </h6>
                                        <span>MAR 07, 2021</span>
                                    </div>
                                </a>
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/gdlj2.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Guadalajara<br /> </h6>
                                        <span>Nov 23, 2023</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <h3>Casa Kuri</h3>
                        <img src="img/blog/details/Prod.jpg" alt="">
                        <p>En Casa Kuri, nos enorgullecemos de ofrecerte los mejores productos de papelería del mercado. Desde útiles escolares hasta suministros de oficina, tenemos todo lo que necesitas para tu día a día. Nuestra amplia gama de productos incluye lápices, plumas, cuadernos, carpetas, y mucho más, siempre con la mejor calidad y a precios competitivos.
                            Sabemos lo importante que es contar con materiales confiables y de alta calidad, por eso, trabajamos incansablemente para asegurarnos de que cada artículo que encuentres en Casa Kuri cumpla con tus expectativas. Ya sea que estés preparando a tus hijos para el nuevo año escolar o abasteciendo tu oficina, estamos aquí para ayudarte a encontrar exactamente lo que necesitas.
                            Además, en Casa Kuri creemos en la importancia de un servicio al cliente excepcional. Nos comprometemos a brindarte una experiencia de compra agradable y personalizada. Nuestro equipo está siempre dispuesto a asesorarte y resolver cualquier duda que puedas tener.
                            Te invitamos a visitar nuestra tienda y descubrir por ti mismo la diferencia que hace comprar en Casa Kuri. Únete a nuestra familia de clientes satisfechos y disfruta de los beneficios de comprar en una tienda que realmente se preocupa por ti.</p>
                        <h3>Casa Kuri: Tu Aliado de Confianza en Productos de Papelería de Alta Calidad para Todas tus Necesidades</h3>
                        <p>En Casa Kuri, nos esforzamos diariamente para ser tu mejor opción en productos de papelería. Nos enorgullece ofrecer una amplia selección de artículos de la más alta 
                            calidad, respaldados por un servicio al cliente excepcional. Creemos en la importancia de los pequeños detalles y en la diferencia que estos pueden hacer en tu vida diaria, ya sea en el ámbito escolar, profesional o personal. Te invitamos a unirte a nuestra comunidad de clientes satisfechos y a experimentar la comodidad y satisfacción de comprar con una empresa que valora tu confianza y se dedica a brindarte lo mejor. Gracias por elegir Casa Kuri, donde cada compra es una inversión en calidad y servicio.</p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/desu.jpg" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Felipe Cruz</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Cualidades:</span> Creativo, Responsable, Lider</li>
                                    </ul>
                                    <div class="blog__details__social">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/alex.jpg" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Alex Fajardo</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Cualidades:</span> Responsable, Empatico, lider</li>
                                    </ul>
                                    <div class="blog__details__social">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/rosbb.png" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Diego Rosales</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Cualidades:</span> Puntual, Resiliente, Responsable</li>
                                    </ul>
                                    <div class="blog__details__social">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <!-- Related Blog Section End -->

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