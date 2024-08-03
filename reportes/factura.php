<?php
require("../fpdf186/fpdf.php");
require "../BD/conexion.php"; // Asegúrate de incluir la conexión a la base de datos

$ven_id = isset($_GET['ven_id']) ? intval($_GET['ven_id']) : 0;

if ($ven_id > 0) {
    // Realizar la consulta para obtener los datos de la factura
    $sqlFactura = "SELECT fac_nombre, fac_rfc, fac_domicilio, fac_fecha, rf_descripcion, cfdi_descripcion, ven_total 
                   FROM facturas
                   INNER JOIN regimen_fiscal ON regimen_fiscal.rf_id = facturas.rf_id
                   INNER JOIN cfdi_uso ON cfdi_uso.cfdi_id = facturas.cfdi_id
                   INNER JOIN venta ON venta.ven_id = facturas.ven_id 
                   WHERE facturas.ven_id = $ven_id;";
    $Factura = $conn->query($sqlFactura);

    // Realizar la consulta para obtener los detalles de la venta
    $sqlVenta = "SELECT deve_cantidad, pro_Producto 
                 FROM detalle_venta
                 INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                 INNER JOIN productos ON inventario.pro_id = productos.pro_id
                 WHERE detalle_venta.ven_id = $ven_id;";
    $Ventas = $conn->query($sqlVenta);

    // Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configuración de fuentes y márgenes
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetXY(100, 10);
    $pdf->Cell(100, 10, 'CASA KURI', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(100, 20);
    $pdf->Cell(100, 10, 'RFC: CKU621101CH8', 1, 1);
    $pdf->SetXY(100, 30);
    $pdf->Cell(100, 10, 'Domicilio: OLMOS No. 316 SUR, Tampico Centro,', 1, 1);
    $pdf->SetXY(100, 40);
    $pdf->Cell(100, 10, 'C.P. 89000, Tampico, Tamaulipas, Mexico', 1, 1);
    $pdf->SetXY(100, 50);
    $pdf->Cell(100, 10, 'Tipo de Comprobante: I - Ingreso', 1, 1);
    $pdf->SetXY(100, 60);
    $pdf->Cell(100, 10, 'Lugar de Expedicion: 89000', 1, 1);
    $pdf->SetXY(100, 70);
    $pdf->Cell(100, 10, 'Regimen Fiscal: 626 - Regimen Simplificado de Confianza', 1, 1);
    $pdf->Ln(10);

    // Información de pago (más ancho y menos espacio)
    $pdf->SetXY(10, 80);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(100, 8, 'Forma de pago: Paypal', 1, 1);
    $pdf->SetXY(10, 88);
    $pdf->Cell(100, 8, 'Metodo de pago: PUE - Pago en una sola exhibicion', 1, 1);
    $pdf->SetXY(10, 96);
    $pdf->Cell(100, 8, 'Moneda: MXN - Peso Mexicano', 1, 1);
    $pdf->SetXY(10, 104);
    $pdf->Cell(100, 8, 'Exportacion: 01 - No aplica', 1, 1);
    $pdf->Ln(10);


    // Información del cliente (en dos columnas, centrado y con menos espacio)
    $pdf->SetXY(10, 120);
    $pdf->Cell(0, 10, 'Datos del cliente', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);

    if ($venta = $Factura->fetch_assoc()) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'Cliente: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['fac_nombre'], 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'R.F.C.: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['fac_rfc'], 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'Domicilio fiscal: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['fac_domicilio'], 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'Fecha: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['fac_fecha'], 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'Regimen Fiscal: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['rf_descripcion'], 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 8, 'Uso del CFDI: ', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 8, $venta['cfdi_descripcion'], 1);
        $pdf->Ln(15); // Espacio de separación

        // Detalles de la venta
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, 'Cantidad', 1);
        $pdf->Cell(30, 10, 'Unidad', 1);
        $pdf->Cell(50, 10, 'Concepto / Descripcion', 1);
        $pdf->Cell(30, 10, 'Impuestos', 1);
        $pdf->Cell(30, 10, 'Importe', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        while ($detalle = $Ventas->fetch_assoc()) {
            $pdf->Cell(20, 10, $detalle['deve_cantidad'], 1);
            $pdf->Cell(30, 10, 'Pieza', 1); // Aquí necesitas obtener la unidad del producto
            $pdf->Cell(50, 10, $detalle['pro_Producto'], 1);
            $pdf->Cell(30, 10, '0.16%', 1); // Aquí necesitas calcular los impuestos
            $pdf->Cell(30, 10, $venta['ven_total'], 1); // Aquí necesitas calcular el importe total
            $pdf->Ln();
        }

        // Espacio entre la tabla de productos y los totales
        $pdf->Ln(10);

        // Total de la factura
        $pdf->Cell(0, 10, 'Subtotal: ' . $venta['ven_total'], 1, 1, 'R'); // Aquí necesitas calcular el subtotal
        $pdf->Cell(0, 10, 'Total: ' . $venta['ven_total'], 1, 1, 'R');
    } else {
        $pdf->Cell(0, 10, 'No se encontraron datos para la venta.', 1, 1);
    }

    $pdf->Output();
} else {
    echo "Error: No se ha proporcionado un ID de venta válido.";
}
?>
