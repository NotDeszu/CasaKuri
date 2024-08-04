<?php

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

require("../fpdf186/fpdf.php");
require('../BD/conexion.php');
session_start();
include("../funciones/usuario.php");
include("../funciones/numeCadena.php");

// Obtener la última venta del usuario
$sql_detalles_venta = "SELECT venta.ven_id, ven_total, ven_subtotal, detalle_venta.inv_id, deve_cantidad, pro_Producto
                        FROM venta
                        INNER JOIN detalle_venta ON venta.ven_id = detalle_venta.ven_id
                        INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                        INNER JOIN productos ON inventario.pro_id = productos.pro_id
                        WHERE venta.usu_id = $usuario_id
                        ORDER BY venta.ven_fecha DESC
                        LIMIT 1"; // Obtiene solo la última venta

$result_detalles_venta = $conn->query($sql_detalles_venta);
$ultima_venta = $result_detalles_venta->fetch_assoc();
$ultima_venta_id = $ultima_venta['ven_id'];
$total = $ultima_venta['ven_total'];
$subtotal = $ultima_venta['ven_subtotal'];

// Consulta para obtener los datos de la factura
$sqlFactura = "SELECT fac_nombre, fac_rfc, fac_domicilio, fac_fecha, rf_descripcion, cfdi_descripcion, ven_total 
               FROM facturas
               INNER JOIN regimen_fiscal ON regimen_fiscal.rf_id = facturas.rf_id
               INNER JOIN cfdi_uso ON cfdi_uso.cfdi_id = facturas.cfdi_id
               INNER JOIN venta ON venta.ven_id = facturas.ven_id 
               WHERE facturas.ven_id = $ultima_venta_id;";
$Factura = $conn->query($sqlFactura);
$row_venta = $Factura->fetch_assoc();

// Realizar la consulta para obtener los detalles de la venta
$sqlVenta = "SELECT deve_cantidad, pro_Producto 
             FROM detalle_venta
             INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
             INNER JOIN productos ON inventario.pro_id = productos.pro_id
             WHERE detalle_venta.ven_id = $ultima_venta_id;";
$Ventas = $conn->query($sqlVenta);

$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);


$pdf->Ln(7);

$pdf->MultiCell(70, 5, 'CASA KURI', 0, 'C');

$pdf->Ln(1);


$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant.', 0, 0, 'L');
$pdf->Cell(30, 4, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(15, 4, 'Precio', 0, 0, 'C');
$pdf->Cell(15, 4, 'Importe', 0, 1, 'C');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$totalProductos = 0;
$pdf->SetFont('Arial', '', 7);

while ($row_detalle = $Ventas->fetch_assoc()) {
    $importe = number_format($row_detalle['deve_cantidad'] * $row_venta['ven_total'], 2, '.', ',');
    $totalProductos += $row_detalle['deve_cantidad'];

    $pdf->Cell(10, 4, $row_detalle['deve_cantidad'], 0, 0, 'L');

    $yInicio = $pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_detalle['pro_Producto'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $yFin = $pdf->GetY();

    $pdf->SetXY(45, $yInicio);

    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($row_venta['ven_total'], 2, '.', ','), 0, 0, 'C');

    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');
    $pdf->SetY($yFin);
}

$Ventas->close();

$pdf->Ln();

$pdf->Cell(70, 4, mb_convert_encoding('Número de articulos:  ' . $totalProductos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 5, sprintf('Subtotal: %s  %s', MONEDA, number_format($subtotal, 2, '.', ',')), 0, 1, 'R');
$pdf->Cell(70, 5, sprintf('Total IVA: %s  %s', MONEDA, number_format($total, 2, '.', ',')), 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(70, 4, 'Son ' . strtolower(NumeroALetras::convertir($total, MONEDA_LETRA, MONEDA_DECIMAL)), 0, 'L', 0);

$pdf->Ln();

$pdf->Cell(35, 5, 'Fecha: ' . $row_venta['fac_fecha'], 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . date('H:i:s', strtotime($row_venta['fac_fecha'])), 0, 1, 'C');

$pdf->Ln();

$pdf->MultiCell(70, 5, 'GRACIAS POR TU COMPRA!!!', 0, 'C');

$Factura->close();
$conn->close();

$pdf->Output();
?>
