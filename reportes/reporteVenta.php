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

$pdf->SetFont('Arial', 'B', 12);  // Aumenté el tamaño de la fuente
$pdf->Ln(10);

$header = array('V.ID', 'Nombre', 'Apellidos', 'Fecha', 'Total');
$widths = array(15, 40, 50, 35, 40);  // Ajusté los anchos de las columnas

for($i=0; $i<count($header); $i++)
    $pdf->Cell($widths[$i], 8, $header[$i], 1, 0, 'C');  // Aumenté la altura de la celda
$pdf->Ln();

$pdf->SetFont('Arial', '', 11);  // Aumenté el tamaño de la fuente

$totalmax = 0;

$sql = "SELECT ven_id, usu_nombre, usu_apellidop, usu_apellidom, ven_fecha, ven_total FROM venta INNER JOIN usuarios ON usuarios.usu_id = venta.usu_id";

$ventas = $conn->query($sql);

while ($row_ventas = $ventas->fetch_assoc()) {
    $pdf->Cell($widths[0], 8, $row_ventas['ven_id'], 1);
    $pdf->Cell($widths[1], 8, $row_ventas['usu_nombre'], 1);
    $pdf->Cell($widths[2], 8, $row_ventas['usu_apellidop'].' '.$row_ventas['usu_apellidom'], 1);
    $pdf->Cell($widths[3], 8, $row_ventas['ven_fecha'], 1);
    $pdf->Cell($widths[4], 8, $row_ventas['ven_total'], 1, 1, 'R');

    $totalmax += $row_ventas['ven_total'];
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Total de ventas: $' . number_format($totalmax, 2), 0, 1, 'R');

$pdf->Output();
?>
