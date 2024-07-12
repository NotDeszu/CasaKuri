
<?php
include("../BD/conexion.php");
// require("/xampp/htdocs/CRUD2/fpdf186/fpdf.php");
require("../fpdf186/fpdf.php");
$pdf = new FPDF(); //clase nueva de FPDF
$pdf->AddPage();    //ORIENTACION, TAMAÑO, ROTACION
$pdf->SetFont('Arial', 'B', 24); //FUENTES ESTILO Y TAMAÑO

$pdf->Cell(190, 10, 'Reporte de productos', 1, 0, "C"); // Intruccion de valores

$pdf->SetFont('Arial', 'B', 12); //FUENTES ESTILO Y TAMAÑO
$pdf->Ln();
$pdf->Cell(190, 10, "  ID            PRODUCTO             Precio               Descripcion" );
$pdf->SetX(170);
$pdf->Cell(30, 10, "Categorias" );
$pdf->Ln();
$pdf->Cell(190,2,"",0,0,"",true);
$pdf->SetFont('Arial','', 12);
$sql = "SELECT  id, Producto, precio, decripcion, categoria, productos.id_cat  from productos inner join categoria on categoria.id_cat = productos.id_cat order by id";
$productos = $conn->query($sql);

while ($row_productos = $productos->fetch_assoc()) { 
    $pdf->Ln();
    $pdf->Cell(15, 10, $row_productos['id']);
    $pdf->Cell(45, 10, $row_productos['Producto']);
    $pdf->Cell(20, 10, $row_productos['precio']);
    $pdf->Cell(50, 10, $row_productos['decripcion']);
    $pdf->SetX(170);
    $pdf->Cell(10, 10, $row_productos['categoria']);
}



$pdf->Output(); // Salida de PDF
