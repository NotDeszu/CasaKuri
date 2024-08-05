<?php
require("../fpdf186/fpdf.php");
require "../BD/conexion.php"; // Asegúrate de incluir la conexión a la base de datos

$ven_id = isset($_GET['ven_id']) ? intval($_GET['ven_id']) : 0;

if ($ven_id > 0) {
    // Realizar la consulta para obtener los datos de la factura
    $sqlFactura = "SELECT fac_nombre, fac_rfc, fac_domicilio, fac_fecha, rf_descripcion, cfdi_descripcion, ven_total, ven_subtotal 
                   FROM facturas
                   INNER JOIN regimen_fiscal ON regimen_fiscal.rf_id = facturas.rf_id
                   INNER JOIN cfdi_uso ON cfdi_uso.cfdi_id = facturas.cfdi_id
                   INNER JOIN venta ON venta.ven_id = facturas.ven_id 
                   WHERE facturas.ven_id = $ven_id;";
    $Factura = $conn->query($sqlFactura);

    // Realizar la consulta para obtener los detalles de la venta
    $sqlProductos = "SELECT deve_cantidad, pro_precioIVA, productos.pro_producto, pro_precioIVA * deve_cantidad as producto 
                     FROM detalle_venta 
                     INNER JOIN venta ON venta.ven_id = detalle_venta.ven_id
                     INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                     INNER JOIN productos ON inventario.pro_id = productos.pro_id
                     WHERE detalle_venta.ven_id = $ven_id";
    $res_productos = $conn->query($sqlProductos);

    // Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configuración de fuentes y márgenes
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetMargins(10, 10, 10);

    // Título principal
    $pdf->Cell(0, 10, 'CASA KURI', 0, 1, 'C');
    $pdf->Ln(10);

    // Información de la tienda
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Datos de la tienda', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'RFC: CKU621101CH8', 1, 1);
    $pdf->Cell(0, 10, 'Domicilio: Prol. Ezequiel Montes, Queretaro,', 1, 1);
    $pdf->Cell(0, 10, 'C.P. 76130, QUERETARO, QUERETARO, Mexico', 1, 1);
    $pdf->Cell(0, 10, 'Tipo de Comprobante: I - Ingreso', 1, 1);
    $pdf->Cell(0, 10, 'Regimen Fiscal: 626 - Regimen Simplificado de Confianza', 1, 1);
    $pdf->Ln(10);

    // Información de pago
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 8, 'Forma de pago: Paypal', 1, 1);
    $pdf->Cell(0, 8, 'Metodo de pago: PUE - Pago en una sola exhibicion', 1, 1);
    $pdf->Cell(0, 8, 'Moneda: MXN - Peso Mexicano', 1, 1);
    $pdf->Cell(0, 8, 'Exportacion: 01 - No aplica', 1, 1);
    $pdf->Ln(10);

    // Información del cliente
    if ($venta = $Factura->fetch_assoc()) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Datos del cliente', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(95, 8, 'Cliente: ', 1);
        $pdf->Cell(95, 8, $venta['fac_nombre'], 1);
        $pdf->Ln();
        $pdf->Cell(95, 8, 'R.F.C.: ', 1);
        $pdf->Cell(95, 8, $venta['fac_rfc'], 1);
        $pdf->Ln();
        $pdf->Cell(95, 8, 'Domicilio fiscal: ', 1);
        $pdf->Cell(95, 8, $venta['fac_domicilio'], 1);
        $pdf->Ln();
        $pdf->Cell(95, 8, 'Fecha: ', 1);
        $pdf->Cell(95, 8, $venta['fac_fecha'], 1);
        $pdf->Ln();
        $pdf->Cell(95, 8, 'Regimen Fiscal: ', 1);
        $pdf->Cell(95, 8, $venta['rf_descripcion'], 1);
        $pdf->Ln();
        $pdf->Cell(95, 8, 'Uso del CFDI: ', 1);
        $pdf->Cell(95, 8, $venta['cfdi_descripcion'], 1);
        $pdf->Ln(15); // Espacio de separación

        // Detalles de la venta
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, 'Cantidad', 1);
        $pdf->Cell(20, 10, 'Unidad', 1);
        $pdf->Cell(40, 10, 'Producto', 1);
        $pdf->Cell(20, 10, 'Impuesto', 1);
        $pdf->Cell(20, 10, 'Precio', 1);
        $pdf->Cell(30, 10, 'Subtotal', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        while ($detalle = $res_productos->fetch_assoc()) {
            $pdf->Cell(20, 10, $detalle['deve_cantidad'], 1);
            $pdf->Cell(20, 10, 'Pieza', 1);
            $pdf->Cell(40, 10, mb_convert_encoding($detalle['pro_producto'], 'ISO-8859-1', 'UTF-8'), 1);
            $pdf->Cell(20, 10, '0.16', 1);
            $pdf->Cell(20, 10, number_format($detalle['pro_precioIVA'], 2, '.', ','), 1);
            $pdf->Cell(30, 10, number_format($detalle['producto'], 2, '.', ','), 1);
            $pdf->Ln();
        }

        // Espacio entre la tabla de productos y los totales
        $pdf->Ln(10);

        // Total de la factura
        $pdf->Cell(0, 10, 'Subtotal: ' . number_format($venta['ven_subtotal'], 2, '.', ','), 1, 1, 'R');
        $pdf->Cell(0, 10, 'Total: ' . number_format($venta['ven_total'], 2, '.', ','), 1, 1, 'R');
    } else {
        $pdf->Cell(0, 10, 'No se encontraron datos para la venta.', 1, 1);
    }

    $pdf->Output();
} else {
    echo "Error: No se ha proporcionado un ID de venta válido.";
}
?>
