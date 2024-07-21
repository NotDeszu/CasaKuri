
<?php
include("../BD/conexion.php");
// require("/xampp/htdocs/CRUD2/fpdf186/fpdf.php");
require("../fpdf186/fpdf.php");
$pdf = new FPDF(); //clase nueva de FPDF
$pdf->AddPage();    //ORIENTACION, TAMAÑO, ROTACION
$pdf->SetFont('Arial', 'B', 24); //FUENTES ESTILO Y TAMAÑO

$pdf->Cell(150, 10, 'Reporte de productos', 0, 0, "C"); // Intruccion de valores
$pdf->Image("logo.png", 140, 5, 60,18, 'png' );

$pdf->SetFont('Arial', 'B', 12); //FUENTES ESTILO Y TAMAÑO
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(190, 10, "  ID            PRODUCTO             Precio               Descripcion" );
$pdf->SetX(170);
$pdf->Cell(30, 10, "Categoria" );
$pdf->Ln();
$pdf->Cell(195,2,"",0,0,"",true);
$pdf->SetFont('Arial','', 12);
$sql = "SELECT  pro_id, pro_producto, pro_precio, pro_decripcion, categoria.cat_nombre  from productos inner join categoria on categoria.cat_id = productos.cat_id order by pro_id";
$productos = $conn->query($sql);

while ($row_productos = $productos->fetch_assoc()) { 
    $pdf->Ln();
    $pdf->Cell(15, 10, $row_productos['pro_id']);
    $pdf->Cell(45, 10, $row_productos['pro_producto']);
    $pdf->Cell(20, 10, $row_productos['pro_precio']);
    $pdf->Cell(50, 10, $row_productos['pro_decripcion']);
    $pdf->SetX(170);
    $pdf->Cell(10, 10, $row_productos['cat_nombre']);
}



$pdf->Output(); // Salida de PDF
