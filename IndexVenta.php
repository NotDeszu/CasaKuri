<?php
session_start();
if(empty($_SESSION["usu_id"])){
    header("location: Front/ogani/login3.php");
    exit();
}

if($_SESSION["rol_id"] != 1){
    header("location: Front/ogani/index.php");
    exit();
}
?>

<?php
require "BD/conexion.php";
?>
<?php

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$sqlVentas = "SELECT ven_id, usu_nombre, usu_apellidop, usu_apellidom, ven_email, ven_fecha, ven_total 
              FROM venta 
              INNER JOIN usuarios ON usuarios.usu_id = venta.usu_id";

if (!empty($startDate) && !empty($endDate)) {
    $sqlVentas .= " WHERE ven_fecha BETWEEN '$startDate' AND '$endDate'";
}

$ventas = $conn->query($sqlVentas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>ventas</title>
</head>

<body>
<?php
        include("menus/menuAdmin.php") ?>
    <div class="container py-3">
        <h2 class="text-center">Ventas</h2>

        <div class="row justify-content-end">

            <div class="col-auto">
                <form action="reportes/reporteVenta.php">
                    <button type="submit" class="btn btn-warning">REPORTES <i class="bi bi-file-earmark"></i>
                    </button>
                </form>
            </div>
        </div>
        <form method="get" action="">
            <label for="start_date">Fecha inicial: </label>
            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($startDate) ?>">

            <label for="end_date">Fecha final: </label>
            <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($endDate) ?>">

            <button type="submit">Filtrar</button>
        </form>

        <table class="table table-sm table-striped table-hover text-center mt-4">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID Venta</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row_ventas = $ventas->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row_ventas['ven_id']); ?></td>
                <td><?= htmlspecialchars($row_ventas['usu_nombre']); ?></td>
                <td><?= htmlspecialchars($row_ventas['usu_apellidop'] . ' ' . $row_ventas['usu_apellidom']); ?></td>
                <td><?= htmlspecialchars($row_ventas['ven_fecha']); ?></td>
                <td><?= htmlspecialchars($row_ventas['ven_total']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
