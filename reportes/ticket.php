<?php

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

require("../fpdf186/fpdf.php");
require('../BD/conexion.php');
session_start();
include("../funciones/usuario.php");
include("../funciones/numeCadena.php");

// Consultas SQL
$sqlUltimaventa = "SELECT venta.ven_id, ven_total, ven_subtotal
                   FROM venta
                   WHERE venta.usu_id = $usuario_id  
                   ORDER BY venta.ven_fecha DESC
                   LIMIT 1";

$res_ultimavena = $conn->query($sqlUltimaventa);
$ultima_venta = $res_ultimavena->fetch_assoc();
$ultima_venta_id = $ultima_venta['ven_id'];
$total = $ultima_venta['ven_total'];
$subtotal = $ultima_venta['ven_subtotal'];

$sqlProductos = "SELECT deve_cantidad, pro_precioIVA, productos.pro_producto, pro_precioIVA * deve_cantidad as producto 
                 FROM detalle_venta 
                 INNER JOIN venta ON venta.ven_id = detalle_venta.ven_id
                 INNER JOIN inventario ON inventario.inv_id = detalle_venta.inv_id
                 INNER JOIN productos ON inventario.pro_id = productos.pro_id
                 WHERE detalle_venta.ven_id = $ultima_venta_id";

$res_productos = $conn->query($sqlProductos);

// Generación del ticket con FPDF
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
$pdf->Cell(15, 4, 'Precio ', 0, 0, 'C');
$pdf->Cell(15, 4, 'Subtotal', 0, 1, 'C');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$totalProductos = 0;
$pdf->SetFont('Arial', '', 7);

while ($row_productos = $res_productos->fetch_assoc()) {
    $cantidad = $row_productos['deve_cantidad'];
    $producto = mb_convert_encoding($row_productos['pro_producto'], 'ISO-8859-1', 'UTF-8');
    $precio = $row_productos['pro_precioIVA'];
    $importe = number_format($row_productos['producto'], 2, '.', ',');

    $totalProductos += $cantidad;

    $pdf->Cell(10, 4, $cantidad, 0, 0, 'L');

    $yInicio = $pdf->GetY();
    $pdf->MultiCell(30, 4, $producto, 0, 'L');
    $yFin = $pdf->GetY();

    $pdf->SetXY(45, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($precio, 2, '.', ','), 0, 0, 'C');

    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');
    $pdf->SetY($yFin);
}

$res_ultimavena->close();

$pdf->Ln();

$pdf->Cell(70, 4, mb_convert_encoding('Número de artículos:  ' . $totalProductos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 5, sprintf('Subtotal: %s  %s', MONEDA, number_format($subtotal, 2, '.', ',')), 0, 1, 'R');
$pdf->Cell(70, 5, sprintf('Total IVA: %s  %s', MONEDA, number_format($total, 2, '.', ',')), 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(70, 4, 'Son ' . strtolower(NumeroALetras::convertir($total, MONEDA_LETRA, MONEDA_DECIMAL)), 0, 'L', 0);

$pdf->Ln();

/* $pdf->Cell(35, 5, 'Fecha: ' . $row_venta['fac_fecha'], 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . date('H:i:s', strtotime($row_venta['fac_fecha'])), 0, 1, 'C'); */

$pdf->Ln();

$pdf->MultiCell(70, 5, 'GRACIAS POR TU COMPRA!!!', 0, 'C');

/* $Factura->close(); */
$conn->close();

$pdf->Output();
?>
