<?php
include("/xampp/htdocs/CRUD2/conexion.php");
include("/xampp/htdocs/CRUD2/fpdf186/html_table.php");


$pdf= new pdf();
$pdf->AddPage();
$pdf->SetFont("Arial","",12);
$pdf->Cell(190,10,"REPORTE CON TABLAS",0,0,"C");
$pdf->Ln();
$micenabeza= '
<table border="1">
<td width=20></td>
<td width=60> ID</td>
<td width=150>Producto</td>
<td width=170>Categoria</td>
<td width=100>Precio</td>
<td width=300>Descripcion</td>
</tr>
</table>';

$pdf->SetFont("Arial","",9);
// query productos
$sql = "SELECT  id, Producto, precio, decripcion, categoria, productos.id_cat  from productos inner join categoria on categoria.id_cat = productos.id_cat order by id";
$productos = $conn->query($sql);

$tablaProductos ='<table border="1">';

while ($row_productos = $productos->fetch_assoc()) { 
    $tablaProductos.='
<tr>
<td width=60>'.$row_productos['id'].'</td>
<td width=150>'.$row_productos['Producto'].'</td>
<td width=170>'.$row_productos['categoria'].'</td>
<td width=100>'.$row_productos['precio'].'</td>
<td width="300">'.$row_productos['decripcion'].'</td>
</tr>';
       
}
$tablaProductos.='</table>';

$pdf->WriteHTML($micenabeza);
$pdf->WriteHTML($tablaProductos);


$pdf->SetFont("Arial","",20);
$pdf->Cell(190,10,"T229");
$pdf->Ln();
$pdf->Cell(190,10,"Edgar Alexander Cuervo Fajardo");
$pdf->Ln();
$pdf->Cell(190,10,"Felipe de Jesus Cruz Bautista");
$pdf->Ln();
$pdf->Cell(190,10,"Diego Rosales Garza");

$pdf->Output();

