<!-- Modal -->
<div class="modal fade" id="EditaModalInv" tabindex="-1" aria-labelledby="ModalInveMLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalInveMLabel">Editar - Inventario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="funciones/actualizarInv.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <!-- Existencia -->
                    <div class="mb-3">
                        <label for="categorias" class="form-label">Producto</label>                        
                        <h6 id="productoNombre"></h6>
                    </div>

                    <!-- Producto -->
                    <div class="mb-3" class="form-label">
                        <label for="descripcion">Sucursal: </label>
                        <h6 id="sucursalNombre"></h6>
                    </div>

                    <div class="mb-3">
                        <label for="producto" class="form-label">Existencia</label>
                        <input type="number" min="0" id="existencia" name="existencia" class="form-control">
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