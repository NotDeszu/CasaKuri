<?php
include("../BD/conexion.php");
require("../fpdf186/fpdf.php");

class PDF extends FPDF
{
    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text==='') return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line)
        {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word)
            {
                $wordwidth = $this->GetStringWidth($word);
                if ($width + $wordwidth <= $maxwidth)
                {
                    $width += $wordwidth + $space;
                    $text .= $word.' ';
                }
                else
                {
                    $width = $wordwidth + $space;
                    $text = rtrim($text)."\n".$word.' ';
                    $count++;
                }
            }
            $text = rtrim($text)."\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 24);

$pdf->Cell(0, 10, 'Reporte de ventas', 0, 1, "C");
$pdf->Image("logo.png", 160, 10, 40, 15, 'png');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(10);

$header = array('V.ID', 'US_ID', 'Fecha', 'Producto', 'Sucursal', 'Inv. ID', 'No.Prod', 'Total');
$widths = array(15, 15, 30, 40, 30, 20, 20, 20);

for($i=0; $i<count($header); $i++)
    $pdf->Cell($widths[$i], 7, $header[$i], 1, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', '', 9);

$sql = "SELECT venta.ven_id, usuarios.usu_nombre, usuarios.usu_id, usu_apellidop, venta.ven_fecha, pro_Producto, sucursal.suc_nombre, detalle_venta.inv_id, deve_cantidad, ven_total
from venta 
inner join detalle_venta on venta.ven_id = detalle_venta.ven_id 
inner join inventario on inventario.inv_id = detalle_venta.inv_id 
inner join productos on inventario.pro_id = productos.pro_id 
inner join usuarios on usuarios.usu_id = venta.usu_id 
inner join sucursal on sucursal.suc_id = inventario.suc_id
order by ven_id";

$ventas = $conn->query($sql);

while ($row_ventas = $ventas->fetch_assoc()) {
    $pdf->Cell($widths[0], 6, $row_ventas['ven_id'], 1);
    $pdf->Cell($widths[1], 6, $row_ventas['usu_id'], 1);
    $pdf->Cell($widths[2], 6, substr($row_ventas['ven_fecha'], 0, 16), 1);
    
    $pdf->SetFont('Arial', '', 8);
    $producto = $row_ventas['pro_Producto'];
    $pdf->Cell($widths[3], 6, $producto, 1);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->Cell($widths[4], 6, $row_ventas['suc_nombre'], 1);
    $pdf->Cell($widths[5], 6, $row_ventas['inv_id'], 1);
    $pdf->Cell($widths[6], 6, $row_ventas['deve_cantidad'], 1);
    $pdf->Cell($widths[7], 6, $row_ventas['ven_total'], 1, 1, 'R');
}

$pdf->Output();