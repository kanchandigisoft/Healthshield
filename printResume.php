<?php
require('fpdf.php');
require('pdfCodeGenerator.php');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Health Shield');
$pdf->Output();
?>