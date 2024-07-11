<?php
session_start();
require "BD/conexion.php";
?>


<?php

$sqlInventario = "SELECT productos.pro_id, productos.pro_Producto,inventario.inv_id, inventario.inv_existencia, sucursal.suc_nombre
FROM inventario
JOIN productos ON inventario.pro_id=productos.pro_id
JOIN sucursal ON inventario.suc_id=sucursal.suc_id";
$inventario = $conn->query($sqlInventario);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
</head>

<body>
    <div class="container py-3">
        <h2 class="text-center">Inventario</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProdModal">
                    Nuevo Inventario <i class="bi bi-plus-circle-fill"></i>
                </button>
            </div>
        </div>

        <table class="table  table-sm table-striped table-hover text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID inventario</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Id producto</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_inventario = $inventario->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row_inventario['inv_id']; ?> </td>
                        <td><?= $row_inventario['pro_id']; ?> </td>
                        <td><?= $row_inventario['pro_Producto']; ?> </td>
                        <td>$<?= $row_inventario['inv_existencia']; ?> </td>
                        <td><?= $row_inventario['suc_nombre']; ?> </td>
                        <td>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditaModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-pencil-square"></i></a>
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-trash-fill"></i></a>
                        </td>

                    </tr>
                <?php }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>