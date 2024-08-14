<?php
include("../BD/conexion.php");
require("../fpdf186/fpdf.php");
$pdf = new FPDF(); //clase nueva de FPDF
$pdf->AddPage();    //ORIENTACION, TAMAÑO, ROTACION
$pdf->SetFont('Arial', 'B', 24); //FUENTES ESTILO Y TAMAÑO

$pdf->Cell(150, 10, 'Reporte de inventarios', 0, 0, "C"); // Intruccion de valores
$pdf->Image("logo.png", 140, 5, 60,18, 'png' );

$pdf->SetFont('Arial', 'B', 12); //FUENTES ESTILO Y TAMAÑO
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(190, 10, "ID del inventario           Producto                          Existencia               Sucursal",0, "C");
$pdf->Cell(195,2,"",0,0,"",true);
$pdf->SetFont('Arial','', 12);
$sql = "SELECT inv_id, productos.pro_Producto  ,inv_existencia, sucursal.suc_nombre from inventario inner join sucursal on sucursal.suc_id = inventario.suc_id inner join productos on productos.pro_id = inventario.pro_id order by inv_id";
$productos = $conn->query($sql);

while ($row_productos = $productos->fetch_assoc()) { 
$pdf->Ln();
$pdf->Cell(47, 10, $row_productos['inv_id']);
$pdf->Cell(50, 10, $row_productos['pro_Producto']);
$pdf->Cell(35, 10, $row_productos['inv_existencia']);
$pdf->Cell(25, 10, $row_productos['suc_nombre']);
}



$pdf->Output(); // Salida de PDF