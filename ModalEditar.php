<!-- Modal -->
<div class="modal fade" id="EditaModal" tabindex="-1" aria-labelledby="EditaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditaModalLabel">Editar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="funciones/actualiza.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id='id' name="id">
                    <!-- Producto -->
                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto</label>
                        <input type="text" id="producto" name="producto" class="form-control">
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" id="precio" name="precio" class="form-control">
                    </div>
                    <!-- Categorias -->
                    <div class="mb-3">
                        <label for="categorias" class="form-label">Categorias</label>
                        <select name="categorias" id="categorias" class="form-select">

                            <?php
                            $sqlCategoria = "SELECT  cat_id, cat_nombre from categoria;";
                            $categoria = $conn->query($sqlCategoria);
                            while ($row_categoria = $categoria->fetch_array()) { ?>

                                <option value="<?php echo $row_categoria["cat_id"]; ?>"> <?= $row_categoria["cat_nombre"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <!-- Descripcion -->
                    <div class="mb-3" class="form-label">
                        <label for="descripcion">Descripcion: </label>
                        <textarea type="text" id="descripcion" name="descripcion" class="form-control"> </textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-3">
                        <img id="img_producto" width="100" height="100">
                    </div>


                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="form-control" accept="image/jpeg">
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