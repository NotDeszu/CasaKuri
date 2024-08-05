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

$sqlVentas = "SELECT venta.ven_id, usuarios.usu_nombre, usu_apellidop, venta.ven_fecha, pro_Producto, sucursal.suc_nombre, detalle_venta.inv_id, deve_cantidad, ven_total
from venta 
inner join detalle_venta on venta.ven_id = detalle_venta.ven_id 
inner join inventario on inventario.inv_id = detalle_venta.inv_id 
inner join productos on inventario.pro_id = productos.pro_id 
inner join usuarios on usuarios.usu_id = venta.usu_id 
inner join sucursal on sucursal.suc_id = inventario.suc_id
order by ven_id";

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


        <table class="table  table-sm table-striped table-hover text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID Venta</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Inventario ID</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Producto</th>
                    <th scope="col">No.Productos</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_ventas = $ventas->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row_ventas['ven_id']; ?> </td>
                                <td><?= $row_ventas['usu_nombre']; ?> </td>
                                <td><?= $row_ventas['usu_apellidop']; ?> </td>
                                <td><?= $row_ventas['ven_fecha']; ?> </td>
                                <td><?= $row_ventas['inv_id']; ?> </td>
                                <td><?= $row_ventas['suc_nombre']; ?> </td>
                                <td><?= $row_ventas['pro_Producto']; ?> </td>
                                <td><?= $row_ventas['deve_cantidad']; ?> </td>
                                <td><?= $row_ventas['ven_total']; ?> </td>
                            </tr>
                <?php    } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
