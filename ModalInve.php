<!-- Modal -->
<div class="modal fade" id="ModalInve" tabindex="-1" aria-labelledby="ModalInveLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalInveLabel">Inventario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="funciones/guardarInv.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id='id' name="id">

                    <!-- Existencia -->
                    <div class="mb-3">
                        <label for="producto" class="form-label">Existencia</label>
                        <input type="text" id="existencia" name="existencia" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label for="categorias" class="form-label">Producto</label>
                        <select name="producto" id="producto" class="form-select">

                            <?php
                            $sqlProductos = "SELECT  pro_id, pro_producto from productos where pro_status=1;";
                            $productos = $conn->query($sqlProductos);
                            while ($row_productos = $productos->fetch_array()) { ?>

                                <option value="<?php echo $row_productos["pro_id"]; ?>"> <?= $row_productos["pro_producto"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <!-- Producto -->
                    <div class="mb-3" class="form-label">
                        <label for="descripcion">Sucursal: </label>
                        <select name="sucursal" id="sucursal" class="form-select">
                            <?php
                            $sqlSucursal = "SELECT  suc_id, suc_nombre from sucursal;";
                            $sucursal = $conn->query($sqlSucursal);
                            while ($row_sucursal = $sucursal->fetch_array()) { ?>

                                <option value="<?php echo $row_sucursal["suc_id"]; ?>"> <?= $row_sucursal["suc_nombre"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>


            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>