<?php
require_once ('../clases/PDF.php');


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->setCvePedido(3);
$pdf->imprimir();
$pdf->Output();
?>