<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/style2.css" type="text/css">
    <link rel="stylesheet" href="css/entrar.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 signup-section">
                <h2>¿No tienes cuenta?</h2>
                <p>Registrate y descubre nuevas posibilidades</p>
                <p>Compra de productos y mas..</p>
                <button id="redirigir" class="btn btn-light">Registrate</button>
                    <script>
                    document.getElementById("redirigir").addEventListener("click", function() {
                    window.location.href = "RegistroUsuario.html";
                    });
                    </script>
                <button id="redirigir2" class="btn"> ver pagina</button>
                <script>
                    document.getElementById("redirigir2").addEventListener("click", function() {
                    window.location.href = "index.php";
                    });
                    </script>
            </div>
            <div class="col-md-6 login-section">
                <h3>Login</h3>
                <form method="post" action="">
                    <?php
                        include "../../BD/conexion.php";
                        include "controlador2_login.php";
                    ?>
                    <div class="form-group">
                        <label for="username"><i class="fa fa-user"></i> Usuario</label>
                        <input name="usu_nombre" type="text" class="form-control" id="usu_nombre" placeholder="Ingresa tu usuario">
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fa fa-lock"></i> Enter Password</label>
                        <input name="usu_pass" type="password" class="form-control" id="usu_pass" placeholder="Enter Password">
                    </div>
                    <div class="botonlogin">
                        <input name="btningresar" id="btningresar" type="submit" value="Login">
                    </div>
                </form>
                <div class="logo">
                    <img src="img/logo rm ck.png" alt="CASA KURI Logo">
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
