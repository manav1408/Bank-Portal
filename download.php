<!DOCTYPE html>
<html>
<head>
	<title>download</title>
</head>
<body>
<?php
ob_start();
require_once('E:\PHP\xampp\htdocs\bank\tcpdf\tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage();
$php='history.php';
$pdf->Write($php, true, 0, true, 0);
$pdf->lastPage();
$pdf->Output('example_021.pdf', 'I');
?>
</body>
</html>