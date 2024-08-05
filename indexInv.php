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

$sqlInventario = "SELECT productos.pro_id, productos.pro_Producto,inventario.inv_id, inventario.inv_existencia, sucursal.suc_nombre
FROM inventario
JOIN productos ON inventario.pro_id=productos.pro_id
JOIN sucursal ON inventario.suc_id=sucursal.suc_id
order by pro_id";

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
    <?php
    include("menus/menuAdmin.php") ?>

    <div class="container py-3">
        <h2 class="text-center">Inventario</h2>



        <?php
        if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        }
        ?>




        <div class="row justify-content-end">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalInve">
                    Nuevo Inventario <i class="bi bi-plus-circle-fill"></i>
                </button>
            </div>
            <div class="col-auto">
                <form action="reportes/reporteinv.php">
                    <button type="submit" class="btn btn-warning">REPORTES <i class="bi bi-file-earmark"></i>
                    </button>
                </form>
            </div>
        </div>

        <table class="table  table-sm table-striped table-hover text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID inventario</th>
                    <th scope="col">Id producto</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_inventario = $inventario->fetch_assoc()) { ?>
                    <?php
                    if($row_inventario["inv_existencia"]>=1){ ?> 
                            <tr>
                                <td><?= $row_inventario['inv_id']; ?> </td>
                                <td><?= $row_inventario['pro_id']; ?> </td>
                                <td><?= $row_inventario['pro_Producto']; ?> </td>
                                <td><?= $row_inventario['inv_existencia']; ?> </td>
                                <td><?= $row_inventario['suc_nombre']; ?> </td>
                                <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditaModalInv" 
                                data-bs-id="<?= $row_inventario['inv_id'] ?>"
                                data-bs-producto="<?= htmlspecialchars($row_inventario['pro_Producto']) ?>"
                                data-bs-sucursal="<?= htmlspecialchars($row_inventario['suc_nombre']) ?>"
                                data-bs-existencia="<?= $row_inventario['inv_existencia'] ?>">
                                <i class="bi bi-pencil-square"></i></a>
</a>
<!-- the line above is where the user edits the record, but I do not know how to get the of the specifed row  -->
                                </td>
                            </tr>
                    <?php   }else{ ?>
                        <tr class ="table-danger">
                                <td><?= $row_inventario['inv_id']; ?> </td>
                                <td><?= $row_inventario['pro_id']; ?> </td>
                                <td><?= $row_inventario['pro_Producto']; ?> </td>
                                <td><?= $row_inventario['inv_existencia']; ?> </td>
                                <td><?= $row_inventario['suc_nombre']; ?> </td>
                                <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditaModalInv" 
                                data-bs-id="<?= $row_inventario['inv_id'] ?>"
                                data-bs-producto="<?= htmlspecialchars($row_inventario['pro_Producto']) ?>"
                                data-bs-sucursal="<?= htmlspecialchars($row_inventario['suc_nombre']) ?>"
                                data-bs-existencia="<?= $row_inventario['inv_existencia'] ?>">
                                <i class="bi bi-pencil-square"></i></a>
<!-- the line above is where the user edits the record, but I do not know how to get the of the specifed row  -->
                                </td>
                            </tr>
                    <?php    } ?>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    include("modalInve.php");
    include("EditaModalInv.php");
    ?>

    <script>
        let nuevoModal = document.getElementById('ModalInve')
        let editarmodal = document.getElementById('EditaModalInv')
        nuevoModal.addEventListener('hide.bs.modal', event => {

        })

        editarmodal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id');
            console.log(id);
            let inputID = editarmodal.querySelector('.modal-body #id')
            let inputexistencias = editarmodal.querySelector('.modal-body #existencia')
            let inputProducto = editarmodal.querySelector('.modal-body #producto')
            let inputSucursal = editarmodal.querySelector('.modal-body #sucursal')

            let url = "funciones/getInventario.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: "POST",
                    body: formData

                }).then(response => response.json())
                .then(data => {

                    inputID.value = data.inv_id
                    inputProducto.value = data.producto
                    inputexistencias.value = data.existencia
                    inputSucursal.value = data.suc_nombre
                })

        })

        document.addEventListener('DOMContentLoaded', function() {
            var editaModalInv = document.getElementById('EditaModalInv')
            editaModalInv.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var id = button.getAttribute('data-bs-id')
                var producto = button.getAttribute('data-bs-producto')
                var sucursal = button.getAttribute('data-bs-sucursal')
                var existencia = button.getAttribute('data-bs-existencia')

                // Update the modal's content
                var modalTitle = editaModalInv.querySelector('.modal-title')
                var idInput = editaModalInv.querySelector('#id')
                var productoNombre = editaModalInv.querySelector('#productoNombre')
                var sucursalNombre = editaModalInv.querySelector('#sucursalNombre')
                var existenciaInput = editaModalInv.querySelector('#existencia')

                modalTitle.textContent = 'Editar - Inventario: ' + producto
                idInput.value = id
                productoNombre.textContent = producto
                sucursalNombre.textContent = sucursal
                existenciaInput.value = existencia
            })
        })

    </script>
</body>
</html>