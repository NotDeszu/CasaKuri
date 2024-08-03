<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Productos</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="indexAdmin.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexInv.php">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexInv.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Front/ogani/controlador_cerrars2.php">Cerrar Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Front/ogani/index.php">Pagina de Inicio</a>
                    </li>
                    <li class ="row justify-content-end align-items-center">
                    <p class="text-white"> 
                    <?php
                        if(empty($_SESSION["usu_id"])){
                            echo " ";
                        }else{ 
                            echo $_SESSION["usu_email"];
                        }
                    ?>
                    </p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>