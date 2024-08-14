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
$sqlProductos = "SELECT  pro_id, pro_producto, pro_precio, pro_precioIVA, pro_decripcion, pro_status, cat_nombre, productos.cat_id  from productos inner join categoria on 
categoria.cat_id = productos.cat_id order by pro_id";
$productos = $conn->query($sqlProductos);

$dir = "funciones/imagenes/";
// merge de version fajardo y felipe
?>

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
<?php
        include("menus/menuAdmin.php") ?>
    <div class="container py-3">
        <h2 class="text-center">Productos</h2>

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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProdModal">
                    Nuevo Producto <i class="bi bi-plus-circle-fill"></i>
                </button>
            </div>

            <div class="col-auto">
                <form action="reportes/reporteprod.php">
                    <button type="submit" class="btn btn-warning">REPORTES <i class="bi bi-file-earmark"></i>
                    </button>
                </form>
            </div>
            <div class="col-auto">
                <form action="reportes/grafica.php">
                    <button type="submit" class="btn btn-warning">Grafica<i class="bi bi-file-earmark"></i>
                    </button>
                </form>
            </div>

        </div>


        <table class="table  table-sm table-striped table-hover text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">con IVA</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_productos = $productos->fetch_assoc()) { ?>
                    <?php
                        if($row_productos["pro_status"]==1){ ?> 
                            <tr>
                                <td><?= $row_productos['pro_id']; ?> </td>
                                <td><?= $row_productos['pro_producto']; ?> </td>
                                <td>$<?= $row_productos['pro_precio']; ?> </td>
                                <td>$<?= $row_productos['pro_precioIVA']; ?> </td>
                                <td><?= $row_productos['cat_nombre']; ?> </td>
                                <td><?= $row_productos['pro_decripcion']; ?> </td>
                                <td> <?php 
                                    if($row_productos["pro_status"]==1){
                                        echo "Activo";
                                    }else{
                                        echo "Inactivo";
                                    } 
                                    ?>
                                    
                                <td>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditaModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-trash-fill"></i></a>
                                </td>

                            </tr>
                    <?php   }elseif($row_productos["pro_status"]==0){ ?>
                        <tr class = "table-danger">
                                <td><?= $row_productos['pro_id']; ?> </td>
                                <td><?= $row_productos['pro_producto']; ?> </td>
                                <td>$<?= $row_productos['pro_precio']; ?> </td>
                                <td>$<?= $row_productos['pro_precioIVA']; ?> </td>
                                <td><?= $row_productos['cat_nombre']; ?> </td>
                                <td><?= $row_productos['pro_decripcion']; ?> </td>
                                <td> <?php
                                        if($row_productos["pro_status"]==0){
                                            echo "Inactivo";
                                        }else{
                                            echo "Activo";
                                        } 
                                        ?>
                                <td>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditaModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarModal" data-bs-id="<?= $row_productos['pro_id'] ?>"> <i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                        <?php    } ?>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php
    $sqlCategoria = "SELECT  cat_id, cat_nombre from categoria;";
    $categoria = $conn->query($sqlCategoria);
    ?>

    <?php
    include("ProdModal.php");
    include("ModalEditar.php");
    include("ModalEliminar.php")
    ?>


    <?php $categoria->data_seek(0); ?>

    <script>
        let nuevoModal = document.getElementById('ProdModal')
        let editarmodal = document.getElementById('EditaModal')
        let eliminaModal = document.getElementById('EliminarModal')

        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #producto').value = ""
            nuevoModal.querySelector('.modal-body #precio').value = ""
            nuevoModal.querySelector('.modal-body #descripcion').value = ""
            nuevoModal.querySelector('.modal-body #categoria').value = ""
            nuevoModal.querySelector('.modal-body #iimagen').value = ""

        })

        editarmodal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id');
            console.log(id);
            let inputID = editarmodal.querySelector('.modal-body #id')
            let inputProducto = editarmodal.querySelector('.modal-body #producto')
            let inputPrecio = editarmodal.querySelector('.modal-body #precio')
            let inputDescripcion = editarmodal.querySelector('.modal-body #descripcion')
            let inputCategorias = editarmodal.querySelector('.modal-body #categorias')
            let inputImagen = editarmodal.querySelector('.modal-body #img_producto')

            let url = "funciones/getProducto.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: "POST",
                    body: formData

                }).then(response => response.json())
                .then(data => {

                    inputID.value = data.pro_id
                    inputProducto.value = data.pro_producto
                    inputPrecio.value = data.pro_precio
                    inputDescripcion.value = data.pro_decripcion
                    inputCategorias.value = data.cat_id
                    inputImagen.src = '<?= $dir ?>' + data.pro_id + 'jpg'
                })

        })

        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            eliminaModal.querySelector('.modal-footer #id').value = id;
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>