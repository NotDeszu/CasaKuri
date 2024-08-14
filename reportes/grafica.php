<?php
include("../BD/conexion.php");
require("../fpdf186/fpdf.php");

// Query the database
$sql_active = "SELECT COUNT(*) as active_count FROM productos WHERE pro_status = 1";
$sql_inactive = "SELECT COUNT(*) as inactive_count FROM productos WHERE pro_status = 0";

$result_active = mysqli_query($conn, $sql_active);
$result_inactive = mysqli_query($conn, $sql_inactive);

$active_count = mysqli_fetch_assoc($result_active)['active_count'];
$inactive_count = mysqli_fetch_assoc($result_inactive)['inactive_count'];
$total_count = $active_count + $inactive_count;

class PDF extends FPDF
{
    function PieChart($w, $h, $data, $colors, $labels, $values, $legend)
    {
        $this->SetFont('Arial', '', 10);
        $this->SetLegends($data, $legend);

        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $margin = 2;
        $hLegend = 5;
        $radius = min($w - $margin * 4 - $hLegend - $this->wLegend, $h - $margin * 2);
        $radius = floor($radius / 2);
        $XDiag = $XPage + $margin + $radius;
        $YDiag = $YPage + $margin + $radius;
        $this->SetFont('Arial', '', 10);
        $this->SetLegends($data, $legend);

        $total = array_sum($data);
        $angle = 0;
        foreach ($data as $i => $val) {
            $angle += ($val * 360) / $total;
            $this->SetFillColor($colors[$i][0], $colors[$i][1], $colors[$i][2]);
            $this->Sector($XDiag, $YDiag, $radius, $angle - ($val * 360) / $total, $angle);
        }

        // Draw legend
        $this->SetFont('Arial', '', 10);
        $x1 = $XPage + 2 * $radius + 4 * $margin;
        $x2 = $x1 + $hLegend + $margin;
        $y1 = $YDiag - $radius + (2 * $radius - $this->wLegend) / 2;
        for ($i = 0; $i < count($data); $i++) {
            $this->SetFillColor($colors[$i][0], $colors[$i][1], $colors[$i][2]);
            $this->Rect($x1, $y1, $hLegend, $hLegend, 'DF');
            $this->SetXY($x2, $y1);
            $this->Cell(0, $hLegend, $labels[$i] . ': ' . $values[$i]);
            $y1 += $hLegend + $margin;
        }
    }

    function SetLegends($data, $format)
    {
        $this->legends = array();
        $this->wLegend = 0;
        $this->sum = array_sum($data);
        foreach ($data as $l => $val)
        {
            $p = sprintf('%.2f', $val / $this->sum * 100);
            $legend = str_replace(array('%l', '%v', '%p'), array($l, $val, $p), $format);
            $this->legends[] = $legend;
            $this->wLegend = max($this->GetStringWidth($legend), $this->wLegend);
        }
    }

    function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
    {
        $d0 = $a - $b;
        if($cw){
            $d = $b;
            $b = $o - $a;
            $a = $o - $d;
        }else{
            $b += $o;
            $a += $o;
        }
        while($a<0)
            $a += 360;
        while($a>360)
            $a -= 360;
        while($b<0)
            $b += 360;
        while($b>360)
            $b -= 360;
        if ($a > $b)
            $b += 360;
        $b = $b/360*2*M_PI;
        $a = $a/360*2*M_PI;
        $d = $b - $a;
        if ($d == 0 && $d0 != 0)
            $d = 2*M_PI;
        $k = $this->k;
        $hp = $this->h;
        if (sin($d/2))
            $MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
        else
            $MyArc = 0;
        //first put the center
        $this->_out(sprintf('%.2F %.2F m',($xc)*$k,($hp-$yc)*$k));
        //put the first point
        $this->_out(sprintf('%.2F %.2F l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
        //draw the arc
        if ($d < M_PI/2){
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
        }else{
            $b = $a + $d/4;
            $MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
        }
        //terminate drawing
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='b';
        else
            $op='s';
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
            $x1*$this->k,
            ($h-$y1)*$this->k,
            $x2*$this->k,
            ($h-$y2)*$this->k,
            $x3*$this->k,
            ($h-$y3)*$this->k));
    }
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(0, 10, 'Status de Productos', 0, 1, 'C');
$pdf->Ln(10);
$pdf->Image("logo.png", 140, 5, 60,18, 'png' );
// Pie chart data
$data = array($active_count, $inactive_count);
$colors = array(
    array(127, 173, 57),  // Purple for Active
    array(175, 57, 57)  // Light Blue for Inactive
);
$labels = array('Activos', 'Inactivos');
$values = array($active_count, $inactive_count);

// Draw pie chart
$pdf->PieChart(190, 100, $data, $colors, $labels, $values, '%l');
// Move cursor below the chart
$pdf->SetY($pdf->GetY() + 50);

// Add summary
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Numero de productos: $total_count", 0, 1);
$pdf->Cell(0, 10, "Productos Activos: $active_count", 0, 1);
$pdf->Cell(0, 10, "Productos Inactivos: $inactive_count", 0, 1);

// Output PDF to browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="product_status_report.pdf"');
$pdf->Output('I', 'product_status_report.pdf');
?>