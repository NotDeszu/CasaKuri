<?php
include("../../BD/conexion.php");
$sqlregimen = "SELECT * FROM regimen_fiscal";
$resultregimen = $conn->query($sqlregimen);

$sqlcfdi = "SELECT * FROM cfdi_uso";
$resultcfdi = $conn->query($sqlcfdi);
?>

<div class="modal fade" id="modalfactura" tabindex="-1" aria-labelledby="modalfacturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalfacturaLabel">Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario de facturación -->
                <form action="Datos.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre/Razón Social</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" required>
                    </div>
                    <div class="mb-3">
                        <label for="regimen" class="form-label">Régimen Fiscal</label>
                        <select class="form-select" id="regimen" name="regimen" required>
                            <option value="">Selecciona el régimen fiscal</option>
                            <?php while ($row = $resultregimen->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($row['rf_clave']); ?>"><?= htmlspecialchars($row['rf_clave']) . " - " . htmlspecialchars($row['rf_descripcion']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                    </div>
                    <div class="mb-3">
                        <label for="uso_cfdi" class="form-label">Uso de CFDI</label>
                        <select class="form-select" id="uso_cfdi" name="uso_cfdi" required>
                            <option value="">Selecciona el uso de CFDI</option>
                            <?php while ($row = $resultcfdi->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($row['cfdi_clave']); ?>"><?= htmlspecialchars($row['cfdi_clave']) . " - " . htmlspecialchars($row['cfdi_descripcion']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="mb-5">
                        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>